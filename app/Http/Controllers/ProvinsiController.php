<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProvinsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinsi = Provinsi::all();
        return view('admin.provinsi.index',compact('provinsi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.provinsi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $provinsi = new Provinsi();
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'min' => ':attribute harus diisi minimal :min karakter ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha' => ':attribute harus diisi huruf ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'kode_provinsi' => 'required|numeric|unique:provinsis|max:34',
            'nama_provinsi' => 'required|unique:provinsis|regex:/^[a-z A-Z]+$/u|min:4|max:34',
        ],$messages);

        $provinsi->kode_provinsi = $request->kode_provinsi;
        $provinsi->nama_provinsi = $request->nama_provinsi;
        $provinsi->save();
        return redirect()->route('provinsi.index')->with(['message'=>'Data Provinsi Berhasil Di Buat']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('admin.provinsi.show',compact('provinsi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        return view('admin.provinsi.edit',compact('provinsi'));
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
     
        $provinsi = Provinsi::findOrFail($id);
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'min' => ':attribute harus diisi minimal :min karakter ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha_num' => ':attribute tidak boleh sama ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'kode_provinsi' => 'required|numeric|unique:provinsis|max:34',
            'nama_provinsi' => 'required|unique:provinsis|regex:/^[a-z A-Z]+$/u|min:4|max:34',
        ],$messages);

        $provinsi->kode_provinsi = $request->kode_provinsi;
        $provinsi->nama_provinsi = $request->nama_provinsi;
        $provinsi->save();
        return redirect()->route('provinsi.index')->with(['message'=>'Data Provinsi Berhasil Di Edit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id)->delete();
        return redirect()->route('provinsi.index')->with(['message'=>'Data Provinsi Berhasil Di Hapus']);
    }
}
