<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;

class SppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spps = Spp::latest()->paginate(30);

        return view('spps.spp.index', compact('spps'));
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
        $this->validate($request, [
            'nominal' => 'required| numeric',
            'tahun' => 'required| numeric',
        ]);

        $data = $request->all();
        $next = $request->tahun + 3;
        $data['tahun'] = $request->tahun . $next;

        if($request->tahun < 2000){
            return back()->with('error', 'tahun tidak wajar');
        }

        if($request->nominal < 10000){
            return back()->with('nominale', 'nominal tidak wajar');
        }

        $save = Spp::create($data);

        if($save){
            return redirect()->route('spp.index')->with('success', 'berhasil menambah data');
        }else{
            return back()->with('error', 'gagal menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function show(Spp $spp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $spp = Spp::find($id);

        return view('spps.spp.edit', compact('spp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nominal' => 'required| numeric',
            'tahun' => 'required| numeric',
        ]);

        $data = $request->all();
        $next = $request->tahun + 3;
        $data['tahun'] = $request->tahun . $next;

        if($request->tahun < 2000){
            return back()->with('error', 'tahun tidak wajar');
        }

        if($request->nominal < 10000){
            return back()->with('nominale', 'nominal tidak wajar');
        }

        $spp = Spp::find($id);
        $save = $spp->update($data);

        if($save){
            return redirect()->route('spp.index')->with('success', 'berhasil edit data');
        }else{
            return back()->with('error', 'gagal edit data');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spp  $spp
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $spp = Spp::find($id);
        $save = $spp->delete();

        if($save){
            return redirect()->route('spp.index')->with('success', 'berhasil hapus data');
        }else{
            return back()->with('error', 'gagal hapus data');
        }
    }
}
