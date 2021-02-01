<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Provinsi;
use Illuminate\Http\Request;

class KotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kota = Kota::with('provinsi')->get();
        return view('admin.kota.index',compact('kota'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinsi = Provinsi::all();
        return view('admin.kota.create', compact('provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kota = new Kota();
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'min' => ':attribute harus diisi minimal :min karakter ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha' => ':attribute harus diisi dengan huruf ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'kode_kota' => 'required|numeric|unique:kotas|max:98',
            'nama_kota' => 'required|regex:/^[a-z A-Z]+$/u|unique:kotas|max:98',
            'id_provinsi' => 'required|numeric',
        ],$messages);

        $kota->kode_kota = $request->kode_kota;
        $kota->nama_kota = $request->nama_kota;
        $kota->id_provinsi = $request->id_provinsi;
        $kota->save();
        return redirect()->route('kota.index')->with(['message'=>'Data Kota Berhasil Di Tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kota = Kota::findOrFail($id);
        $provinsi = Provinsi::all();
        return view('admin.kota.show',compact('kota','provinsi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kota = Kota::findOrFail($id);
        $provinsi = Provinsi::all();
        $selected = $kota->provinsi->pluck('id')->toArray();
        return view('admin.kota.edit',compact('kota','provinsi','selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'min' => ':attribute harus diisi minimal :min karakter ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha' => ':attribute harus diisi dengan huruf ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'kode_kota' => 'required|numeric|unique:kotas|max:98',
            'nama_kota' => 'required|regex:/^[a-z A-Z]+$/u|unique:kotas|max:98',
            'id_provinsi' => 'required|numeric',
        ],$messages);

        $kota = Kota::findOrFail($id);
        $kota->kode_kota = $request->kode_kota;
        $kota->nama_kota = $request->nama_kota;
        $kota->id_provinsi = $request->id_provinsi;
        $kota->save();
        return redirect()->route('kota.index')->with(['message'=>'Data Kota Berhasil Di Edit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\kota  $kota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kota = Kota::findOrFail($id);
        $kota->delete();
        return redirect()->route('kota.index')->with(['message'=>'Data Kota Berhasil Di Hapus']);
    }
}