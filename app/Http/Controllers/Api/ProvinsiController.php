<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use Validator;

class ProvinsiController extends Controller
{
    public function index()
    {
        $provinsi = Provinsi::latest()->get();
        return response([
            'success' => true,
            'message' => 'List Provinsi',
            'data' => $provinsi
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
         //validate data
         $provinsi = Provinsi::make($request->all(), [
            'kode_provinsi'     => 'kode_provinsi',
            'nama_provinsi'   => 'nama_provinsi',
        ],
            [
                'kode_provinsi.required' => 'Masukkan Kode Provinsi !',
                'nama_provinsi.required' => 'Masukkan Nama Provinsi !',
            ]
        );

        if($provinsi->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $provinsi->errors()
            ],400);

        } else {

            $provinsi = Provinsi::create([
                'kode_provinsi'     => $request->input('kode_provinsi'),
                'nama_provinsi'   => $request->input('nama_provinsi')
            ]);


            if ($provinsi) {
                return response()->json([
                    'success' => true,
                    'message' => 'Provinsi Berhasil Disimpan!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Provinsi Gagal Disimpan!',
                ], 400);
            }
        }
    }

    public function show($id)
    {
        $provinsi = Provinsi::whereId($id)->first();

        if ($provinsi) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Provinsi!',
                'data'    => $provinsi
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi Tidak Ditemukan!',
                'data'    => ''
            ], 404);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'kode_provinsi'     => 'required',
            'nama_provinsi'   => 'required',
        ],
            [
                'kode_provinsi.required' => 'Masukkan Kode Provinsi !',
                'nama_provinsi.required' => 'Masukkan Nama Provinsi !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Kosong',
                'data'    => $validator->errors()
            ],400);

        } else {

            $provinsi = Provinsi::whereId($request->input('id'))->update([
                'kode_provinsi'     => $request->input('kode_provinsi'),
                'nama_provinsi'   => $request->input('nama_provinsi'),
            ]);


            if ($provinsi) {
                return response()->json([
                    'success' => true,
                    'message' => 'Provinsi Berhasil Diupdate!',
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Provinsi Gagal Diupdate!',
                ], 500);
            }

        }

    }

    public function destroy($id)
    {
        $provinsi = Provinsi::findOrFail($id);
        $provinsi->delete();

        if ($provinsi) {
            return response()->json([
                'success' => true,
                'message' => 'Provinsi Berhasil Dihapus!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Provinsi Gagal Dihapus!',
            ], 500);
        }
    }
}