<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $petugases = Petugas::where('level', 'petugas')->paginate(30);

        return view('spps.petugas.index', compact('petugases'));
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
        $this->validate($request,[
            'username' => 'required',
            'email' => 'required| email',
            'password' => 'required',
            'nama_petugas' => 'required',
        ]);

        $data = $request->all();
        $data['level'] = 'petugas';
        $data['password'] = Hash::make($request->password);
        $save = Petugas::create($data);

        if($save){
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'level' => 'petugas'
            ]);
            return redirect()->route('petugas.index')->with('success', 'berhasil menambah data');
        }else{
            return back()->with('error', 'gagal menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(Petugas $petugas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $petugas = Petugas::find($id);

        return view('spps.petugas.edit', compact('petugas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'username' => 'required',
            'email' => 'required| email',
            'password' => 'required',
            'nama_petugas' => 'required',
        ]);

        $data = $request->all();
        $data['level'] = 'petugas';
        $data['password'] = Hash::make($request->password);

        $petugas = Petugas::find($id);
        $user = User::where('username', $petugas->username)->first();
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $save = $petugas->update($data);

        if($save){
            return redirect()->route('petugas.index')->with('success', 'berhasil edit data');
        }else{
            return back()->with('error', 'gagal edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $petugas = Petugas::find($id);
        $save = $petugas->delete();

        if($save){
            return redirect()->route('petugas.index')->with('success', 'berhasil hapus data');
        }else{
            return back()->with('error', 'gagal hapus data');
        }
    }
}
