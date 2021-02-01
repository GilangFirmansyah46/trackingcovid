<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class RwController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rw = Rw::with('kelurahan')->get();
        return view('admin.rw.index',compact('rw'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelurahan = Kelurahan::all();
        return view('admin.rw.create',compact('kelurahan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rw = new Rw();
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha_num' => ':attribute harus diisi dengan huruf dan angka ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'nama_rw' => 'required|alpha_num|unique:rws|max:74957',
            'id_kelurahan' => 'required|numeric',
        ],$messages);

        $rw->nama_rw = $request->nama_rw;
        $rw->id_kelurahan = $request->id_kelurahan;
        $rw->save();
        return redirect()->route('rw.index')->with(['message'=>'Data Rw Berhasil Di Tambah']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rw = Rw::findOrFail($id);
        $kelurahan = Kelurahan::all();
        return view('admin.rw.show',compact('rw', 'kelurahan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rw = Rw::findOrFail($id);
        $kelurahan = Kelurahan::all();
        $selected = $rw->kelurahan->pluck('id')->toArray();
        return view('admin.rw.edit',compact('rw', 'kelurahan', 'selected'));
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
     
        $rw = Rw::findOrFail($id);
        $messages = [
            'required' => ':attribute wajib diisi ya !!!',
            'max' => ':attribute harus diisi maksimal :max karakter ya !!!',
            'alpha_num' => ':attribute harus diisi dengan huruf dan angka ya !!!',
            'numeric' => ':attribute harus diisi dengan angka ya !!!',
            'unique' => ':attribute tidak boleh sama ya !!!',
        ];

        $this->validate($request,[
            'nama_rw' => 'required|alpha_num|unique:rws|max:74957',
            'id_kelurahan' => 'required|numeric',
        ],$messages);

        $rw->nama_rw = $request->nama_rw;
        $rw->id_kelurahan = $request->id_kelurahan;
        $rw->save();
        return redirect()->route('rw.index')->with(['message'=>'Data Rw Berhasil Di Edit']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\provinsi  $provinsi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rw = Rw::findOrFail($id)->delete();
        return redirect()->route('rw.index')->with(['message'=>'Data Rw Berhasil Di Hapus']);
    }
}
