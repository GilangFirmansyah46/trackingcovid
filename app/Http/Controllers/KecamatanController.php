<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kota;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kecamatan = Kecamatan::with('kota')->get();
        return view('admin.kecamatan.index',compact('kecamatan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kota = Kota::all();
        return view('admin.kecamatan.create',compact('kota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kecamatan = new Kecamatan();
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'min' => ':attribute harus diisi minimal :min karakter ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha' => ':attribute harus diisi dengan huruf ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'kode_kecamatan' => 'required|numeric|unique:kecamatans|max:7094',
            'nama_kecamatan' => 'required|regex:/^[a-z A-Z]+$/u|unique:kecamatans|max:7094',
            'id_kota' => 'required|numeric',
        ],$messages);

        $kecamatan->kode_kecamatan = $request->kode_kecamatan;
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->id_kota = $request->id_kota;
        $kecamatan->save();
        return redirect()->route('kecamatan.index')->with(['message'=>'Data Kecamatan Berhasil Di Tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kota = Kota::all();
        return view('admin.kecamatan.show',compact('kecamatan','kota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kecamatan = Kecamatan::findOrFail($id);
        $kota = Kota::all();
        $selected = $kecamatan->kota->pluck('id')->toArray();
        return view('admin.kecamatan.edit',compact('kecamatan', 'kota', 'selected'));
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
     
        $kecamatan = Kecamatan::findOrFail($id);
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'min' => ':attribute harus diisi minimal :min karakter ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha' => ':attribute harus diisi dengan huruf ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'kode_kecamatan' => 'required|numeric|unique:kecamatans|max:7094',
            'nama_kecamatan' => 'required|regex:/^[a-z A-Z]+$/u|unique:kecamatans|max:7094',
            'id_kota' => 'required|numeric',
        ],$messages);

        $kecamatan->kode_kecamatan = $request->kode_kecamatan;
        $kecamatan->nama_kecamatan = $request->nama_kecamatan;
        $kecamatan->id_kota = $request->id_kota;
        $kecamatan->save();
        return redirect()->route('kecamatan.index')->with(['message'=>'Data Kecamatan Berhasil Di Edit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kecamatan = Kecamatan::findOrFail($id)->delete();
        return redirect()->route('kecamatan.index')->with(['message'=>'Data Kecamatan Berhasil Di Hapus']);
    }
}
