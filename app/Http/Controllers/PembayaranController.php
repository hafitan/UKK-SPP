<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pembayaran;
use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\Spp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugas = Petugas::where('email', auth()->user()->email)->first();
        if($petugas == NULL) {
            Petugas::create([
                'username' => auth()->user()->username,
                'email' => auth()->user()->email,
                'password' => Hash::make(auth()->user()->level),
                'nama_petugas' => auth()->user()->username,
                'level' => 'admin',
            ]);
        }

        $siswas = Siswa::all();
        $pembayarans = DB::table('pembayaran')
            ->join('petugas', 'pembayaran.id_petugas', '=', 'petugas.id')
            ->join('siswa', 'pembayaran.nisn', '=' ,'siswa.nisn')
            ->join('spp', 'pembayaran.id_spp', '=', 'spp.id')
            ->orderBy('pembayaran.id', 'Desc')->get();

        return view('spps.pembayaran.index', compact('pembayarans', 'siswas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswas = Siswa::all();
        return view('spps.pembayaran.create', compact('siswas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nisn' => 'required',
            'jumlah_bayar' => 'required',
        ]);

        for($i = 0; $i < $request->bayar_berapa; $i++){
            $bulan = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

            $siswa = Siswa::where('nisn', '=', $request->nisn)->first();
            $spp = Spp::where('id', '=', $siswa->id_spp)->first();
            $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)->get();
            // $cek = Pembayaran::where('nisn', $request->nisn)->count();
            // $max = 36 - $cek;
            // $chek = $siswa->id_masuk - $cek;

            if($pembayaran->isEmpty()){
                $bln = 6;
                $tahun = substr($spp->tahun,0,4);
            }else{
                $pembayaran = Pembayaran::where('nisn', '=', $siswa->nisn)
                    ->orderBy('id', 'Desc')->latest()
                    ->first();

                $bln = array_search($pembayaran->bulan_dibayar, $bulan);

                if($bln == 11){
                    $bln = 0;
                    $tahun = $pembayaran->tahun_dibayar + 1;
                }else{
                    $bln = $bln + 1;
                    $tahun = $pembayaran->tahun_dibayar;
                }

                if($pembayaran->tahun_dibayar == substr($spp->tahun, -4, 4) && $pembayaran->bulan_dibayar == 'juni') {
                    return back()->with('error', 'sudah lunas');
                }
            }

            if($request->jumlah_bayar < $spp->nominal){
                return back()->with('tjumlah_bayar', 'Uang yang dimasukan tidak sesuai');
            }

            // if($max == 0){
            //     return back()->with('error', 'sudah lunas');
            // }

            $idp = Petugas::where('email', auth()->user()->email)->first()->id;

            $save = Pembayaran::create([
                'id_petugas' => $idp,
                'nisn' => $request->nisn,
                'tanggal_bayar' => Carbon::now(),
                'bulan_dibayar' => $bulan[$bln],
                'tahun_dibayar' => $tahun,
                'id_spp' => $spp->id,
                'jumlah_bayar' => $spp->nominal
            ]);
        }

        if($save) {
            return redirect()->route('pembayaran.index', $pembayaran->nisn)->with('success', 'data berhasil masuk');
        }else{
            return back()->with('error', 'data gagal masuk');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show($nisn)
    {
        $data  = Pembayaran::where('nisn' , '=' , $nisn)->first();
        $siswa = Siswa::where('nisn', '=', $nisn)->first();
        $spp = Spp::where('id', '=', $siswa->id_spp)->first();
        $kelas = Kelas::where('id' , '=' , $siswa->id_kelas)->first();
        $parameter = [
            'nisn' => $data->nisn,
            'tanggal_bayar' => $data->tanggal_bayar
        ];
        $info =  Pembayaran::where($parameter)->get();
        $total = $info->sum('jumlah_bayar');

        return view('spps.pembayaran.show', compact('data', 'spp', 'info', 'siswa', 'kelas', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        //
    }

    public function getData($nisn, $berapa)
    {
        $siswa = Siswa::where('nisn', '=', $nisn)->first();
        $spp = Spp::where('id', '=', $siswa->id_spp)->first();
        $pembayaran = Pembayaran::where('nisn', $nisn)
            ->orderBy('id', 'Desc')->latest()->first();
        if($pembayaran == null) {
            $data = [
                'nominal' => $spp->nominal * $berapa,
                'bulan' => 'belum pernah bayar',
                'tahun' => '',
            ];
        }else{
            if($pembayaran->tahun_dibayar == substr($spp->tahun,-4,4) && $pembayaran->bulan_dibayar == 'juni'){
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => 'sudah lunas',
                    'tahun' => ','
                ];
            }else{
                $data = [
                    'nominal' => $spp->nominal * $berapa,
                    'bulan' => $pembayaran->bulan_dibayar,
                    'tahun' => $pembayaran->tahun_dibayar,
                ];
            }
        }

        return response()->json($data);
    }

    public function history()
    {
        // dd('test');
        if(auth()->user()->level == 'siswa') {
            $siswa = Siswa::where('email', auth()->user()->email)->first();
            // $pembayarans = Pembayaran::where('nisn', $siswa->nisn)->get();
            $data  = Pembayaran::where('nisn' , '=' , $siswa->nisn)->first();
            $siswa = Siswa::where('nisn', '=', $siswa->nisn)->first();
            $kelas = Kelas::where('id' , '=' , $siswa->id_kelas)->first();
            $pembayarans = DB::table('pembayaran')->where('pembayaran.nisn', $siswa->nisn)
            ->join('petugas' , 'pembayaran.id_petugas' , '=' , 'petugas.id' )
            ->join('siswa' , 'pembayaran.nisn' , '=' , 'siswa.nisn')
            ->join('spp' , 'pembayaran.id_spp' , '=' , 'spp.id')
            ->orderBy('pembayaran.id', 'Desc')->get();

            return view('spps.pembayaran.history', compact('pembayarans', 'data', 'siswa', 'kelas'));

        }else{
            // $pembayarans = Pembayaran::all();
            $pembayarans = DB::table('pembayaran')
            ->join('petugas' , 'pembayaran.id_petugas' , '=' , 'petugas.id' )
            ->join('siswa' , 'pembayaran.nisn' , '=' , 'siswa.nisn')
            ->join('spp' , 'pembayaran.id_spp' , '=' , 'spp.id')
            ->orderBy('pembayaran.id', 'desc')->get();
            return view('spps.pembayaran.history', compact('pembayarans'));
        }

    }
}
