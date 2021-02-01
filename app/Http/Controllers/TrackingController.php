<?php

namespace App\Http\Controllers;

use App\Models\Tracking;
use App\Models\Rw;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tracking = Tracking::with('rw.kelurahan.kecamatan.kota.provinsi')->get();
        return view('admin.tracking.index',compact('tracking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rw = Rw::all();
        return view('admin.tracking.create',compact('rw'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tracking = new Tracking();
        $tracking->jumlah_positif = $request->jumlah_positif;
        $tracking->jumlah_sembuh = $request->jumlah_sembuh;
        $tracking->jumlah_meninggal = $request->jumlah_meninggal;
        $tracking->tanggal = $request->tanggal;
        $tracking->id_rw = $request->id_rw;
        $tracking->save();
        return redirect()->route('tracking.index')->with(['message'=>'Data Berhasil Dibuat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('admin.tracking.show',compact('tracking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tracking = Tracking::findOrFail($id);
        return view('admin.tracking.edit',compact('tracking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    { 
        $tracking = Tracking::findOrFail($id);
        $tracking->jumlah_positif = $request->jumlah_positif;
        $tracking->jumlah_sembuh = $request->jumlah_sembuh;
        $tracking->jumlah_meninggal = $request->jumlah_meninggal;
        $tracking->tanggal = $request->tanggal;
        $tracking->id_rw = $request->id_rw;
        $tracking->save();
        return redirect()->route('tracking.index')->with(['message'=>'Data Berhasil Diedit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tracking = Tracking::findOrFail($id)->delete();
        return redirect()->route('tracking.index')->with(['message1'=>'Data Berhasil Dihapus']);
    }
}
