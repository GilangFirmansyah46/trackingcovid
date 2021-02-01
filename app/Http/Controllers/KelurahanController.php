<?php

namespace App\Http\Controllers;

use App\Models\Kelurahan;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = Kelurahan::with('kecamatan')->get();
        return view('admin.kelurahan.index',compact('kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kecamatan = Kecamatan::all();
        return view('admin.kelurahan.create',compact('kecamatan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kelurahan = new Kelurahan();
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha' => ':attribute harus diisi dengan huruf ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'nama_kelurahan' => 'required|regex:/^[a-z A-Z]+$/u|unique:kelurahans|max:8490',
            'id_kecamatan' => 'required|numeric',
        ],$messages);

        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
        $kelurahan->id_kecamatan = $request->id_kecamatan;
        $kelurahan->save();
        return redirect()->route('kelurahan.index')->with(['message'=>'Data Kelurahan Berhasil Di Tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kecamatan = Kecamatan::all();
        return view('admin.kelurahan.show',compact('kelurahan', 'kecamatan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kelurahan = Kelurahan::findOrFail($id);
        $kecamatan = kecamatan::all();
        $selected = $kelurahan->kecamatan->pluck('id')->toArray();
        return view('admin.kelurahan.edit',compact('kelurahan', 'kecamatan', 'selected'));
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
     
        $kelurahan = Kelurahan::findOrFail($id);
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha' => ':attribute harus diisi dengan huruf ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'nama_kelurahan' => 'required|regex:/^[a-z A-Z]+$/u|unique:kelurahans|max:8490',
            'id_kecamatan' => 'required|numeric',
        ],$messages);

        $kelurahan->nama_kelurahan = $request->nama_kelurahan;
        $kelurahan->id_kecamatan = $request->id_kecamatan;
        $kelurahan->save();
        return redirect()->route('kelurahan.index')->with(['message'=>'Data Kelurahan Berhasil Di Edit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelurahan = Kelurahan::findOrFail($id)->delete();
        return redirect()->route('kelurahan.index')->with(['message'=>'Data Kelurahan Berhasil Di Hapus']);
    }
}
