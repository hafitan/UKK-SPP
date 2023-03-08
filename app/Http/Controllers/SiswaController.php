<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswas = Siswa::latest()->paginate(30);
        $kelases = Kelas::all();
        $spps = Spp::all();

        return view('spps.siswa.index', compact('siswas', 'kelases', 'spps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd('djkahdja');
        $this->validate($request, [
            'nisn' => 'required| numeric',
            'nis' => 'required| numeric',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required',
        ]);

        $data = $request->all();
        // dd($data);
        $data['level'] = 'siswa';
        $data['email'] = $request->nis . '@gmail.com';

        // if($data['nisn'] !== NULL){
        //     return back()->with('error', 'nisn sudah terdaftar');
        // }
        // if($data['nis'] !== NULL){
        //     return back()->with('error', 'nis sudah terdaftar');
        // }
        $save = Siswa::create($data);

        if($save){
            User::create([
                'username' => $request->nama,
                'email' => $request->nis . '@gmail.com',
                'password' => Hash::make($request->nis),
                'level' => 'siswa',
                'nama_petugas' => auth()->user()->username
            ]);
            return redirect()->route('siswa.index')->with('success', 'berhasil menambah data');
        }else{
            return back()->with('error', 'gagal menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $siswa = Siswa::find($id);
        $kelases = Kelas::all();
        $spps = Spp::all();

        return view('spps.siswa.edit', compact('siswa', 'kelases', 'spps'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nisn' => 'required| numeric',
            'nis' => 'required| numeric',
            'nama' => 'required',
            'id_kelas' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_spp' => 'required',
        ]);

        $data = $request->all();
        $data['level'] = 'siswa';
        $data['email'] = $request->nis . '@gmail.com';

        $siswa = Siswa::find($id);
        // $user = User::where('email', $siswa->email)->first();
        // $user->update([
        //     'username' => $request->nama,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->nis),
        // ]);
        $save = $siswa->update($data);

        if($save){
            return redirect()->route('siswa.index')->with('success', 'berhasil edit data');
        }else{
            return back()->with('error', 'gagal edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        $save = $siswa->delete();

        if($save){
            return redirect()->route('siswa.index')->with('success', 'berhasil hapus data');
        }else{
            return back()->with('error', 'gagal hapus data');
        }
    }
}
