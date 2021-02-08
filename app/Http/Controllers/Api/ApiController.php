<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use DB;
use App\Models\Provinsi;
use App\Models\Tracking;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class ApiController extends Controller
{
    public function Indonesia(){
        $positif = DB::table('trackings')
                        ->select('trackings.positif')
                        ->sum('trackings.positif');

        $sembuh = DB::table('trackings')
                        ->select('trackings.sembuh')
                        ->sum('trackings.sembuh');

        $meninggal = DB::table('trackings')
                        ->select('trackings.meninggal')
                        ->sum('trackings.meninggal');

        return response([
                    'success' => true,
                    'data' => [
                    'name' => 'Indonesia',
                    'positif'=> $positif,
                    'sembuh'=> $sembuh,
                    'meninggal'=> $meninggal,
                            ],
                                    'message' => ' Berhasil!',

                        ]);

    }

    public function negara()
    {
        $client = new Client(); //GuzzleHttp\Client
        $url = 'https://api.kawalcorona.com';
        $res = json_decode($client->request('GET', $url)->getBody());
        $data=[];
        foreach ($res as $key => $value) {
            $data[$key]['nama_negara']=$value->attributes->Country_Region;
            $data[$key]['positif']=$value->attributes->Confirmed;
            $data[$key]['sembuh']=$value->attributes->Recovered;
            $data[$key]['meninggal']=$value->attributes->Deaths;
        }
        $response= [
            'success' => true,
            'data' => $data,
            'message' => 'berhasil',
        ];
        return response()->json($response);

    }
    
    public function provinsi(){
        $hariini = Carbon::now()->format('d-m-y'); 
        $data_skrg = DB::table('trackings')
                ->select(DB::raw('provinsis.Id'),
                         DB::raw('provinsis.Nama_provinsi'),
                         DB::raw('SUM(trackings.positif) as Positif'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh'),
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('MAX(tanggal) as Tanggal'))
                         ->whereDay('tanggal', '=' , $hariini)
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->join('kecamatans' ,'kelurahans.id_kecamatan', '=', 'kecamatans.id')
                ->join('kotas' ,'kecamatans.id_kota', '=', 'kotas.id')
                ->join('provinsis' ,'kotas.id_provinsi', '=', 'provinsis.id')
                ->whereDate('trackings.tanggal', date('Y-m-d'))
                ->groupby('provinsis.id')
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('provinsis.nama_provinsi as Provinsi'), 
                         DB::raw('SUM(trackings.positif) as Positif'), 
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kota')
                ->join('provinsis', 'provinsis.id', '=', 'kotas.id_provinsi')
                ->groupBy('provinsis.nama_provinsi')
            ->get();

        $rest = [
            'status' => 200,
            'data' => [ 
                'Hari Ini' =>[$data_skrg],
                'Total' =>[$data]
            ],
            'message' => 'Data Kasus Provinsi Ditampilkan'
        ];
        return response()->json($rest, 200);

    }


    public function showprovinsi($id)
    {
        $data_skrg = DB::table('trackings')
                ->select('positif', 'sembuh', 'meninggal')
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->join('kecamatans' ,'kelurahans.id_kecamatan', '=', 'kecamatans.id')
                ->join('kotas' ,'kecamatans.id_kota', '=', 'kotas.id')
                ->join('provinsis' ,'kotas.id_provinsi', '=', 'provinsis.id')
                ->where('provinsis.id', $id)
                ->where('trackings.tanggal', date('Y-m-d'))
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('provinsis.nama_provinsi as Provinsi'), 
                         DB::raw('SUM(trackings.positif) as positif'), 
                         DB::raw('SUM(trackings.meninggal) as meninggal'),
                         DB::raw('SUM(trackings.sembuh) as sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kota')
                ->join('provinsis', 'provinsis.id', '=', 'kotas.id_provinsi')
                ->where('provinsis.id', $id)
                ->groupBy('provinsis.nama_provinsi')
            ->get();
            
        $data_skrg = [
            'Positif' =>$data_skrg->sum('positif'),
            'Sembuh' =>$data_skrg->sum('sembuh'),
            'Meninggal' =>$data_skrg->sum('meninggal'),
        ];
        
        $data = [
            'Positif' =>$data->sum('positif'),
            'Sembuh' =>$data->sum('sembuh'),
            'Meninggal' =>$data->sum('meninggal'),
        ];
        
        $rest = [
            'status' => 200,
            'data' => [
                'Hari Ini' => $data_skrg,
                'Total' => $data
            ],
            'message' => 'Data Kasus Provinsi Ditampilkan'
        ];
        
        return response()->json($rest, 200);
    }

    public function kota(){
        $hariini = Carbon::now()->format('d-m-y'); 
        $data_skrg = DB::table('trackings')
                ->select(DB::raw('kotas.Id'),
                         DB::raw('kotas.Nama_kota'),
                         DB::raw('SUM(trackings.positif) as Positif'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh'),
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('MAX(tanggal) as Tanggal'))
                         ->whereDay('tanggal', '=' , $hariini)
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->join('kecamatans' ,'kelurahans.id_kecamatan', '=', 'kecamatans.id')
                ->join('kotas' ,'kecamatans.id_kota', '=', 'kotas.id')
                ->whereDate('trackings.tanggal', date('Y-m-d'))
                ->groupby('kotas.id')
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('kotas.nama_kota as Kota'), 
                         DB::raw('SUM(trackings.positif) as Positif'), 
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kota')
                ->groupBy('kotas.nama_kota')
            ->get();

        $rest = [
            'status' => 200,
            'data' => [ 
                'Hari Ini' =>[$data_skrg],
                'Total' =>[$data]
            ],
            'message' => 'Data Kasus Kota Ditampilkan'
        ];
        return response()->json($rest, 200);

    }

    public function showkota($id)
    {
        $data_skrg = DB::table('trackings')
                ->select('positif', 'sembuh', 'meninggal')
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->join('kecamatans' ,'kelurahans.id_kecamatan', '=', 'kecamatans.id')
                ->join('kotas' ,'kecamatans.id_kota', '=', 'kotas.id')
                ->where('kotas.id', $id)
                ->where('trackings.tanggal', date('Y-m-d'))
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('kotas.nama_kota as Kota'), 
                         DB::raw('SUM(trackings.positif) as positif'), 
                         DB::raw('SUM(trackings.meninggal) as meninggal'),
                         DB::raw('SUM(trackings.sembuh) as sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                ->join('kotas', 'kotas.id', '=', 'kecamatans.id_kota')
                ->where('kotas.id', $id)
                ->groupBy('kotas.nama_kota')
            ->get();
            
        $data_skrg = [
            'Positif' =>$data_skrg->sum('positif'),
            'Sembuh' =>$data_skrg->sum('sembuh'),
            'Meninggal' =>$data_skrg->sum('meninggal'),
        ];
        
        $data = [
            'Positif' =>$data->sum('positif'),
            'Sembuh' =>$data->sum('sembuh'),
            'Meninggal' =>$data->sum('meninggal'),
        ];
        
        $rest = [
            'status' => 200,
            'data' => [
                'Hari Ini' => $data_skrg,
                'Total' => $data
            ],
            'message' => 'Data Kasus Kota Ditampilkan'
        ];
        
        return response()->json($rest, 200);
    }

    public function kecamatan(){
        $hariini = Carbon::now()->format('d-m-y'); 
        $data_skrg = DB::table('trackings')
                ->select(DB::raw('kecamatans.Id'),
                         DB::raw('kecamatans.Nama_kecamatan'),
                         DB::raw('SUM(trackings.positif) as Positif'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh'),
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('MAX(tanggal) as Tanggal'))
                         ->whereDay('tanggal', '=' , $hariini)
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->join('kecamatans' ,'kelurahans.id_kecamatan', '=', 'kecamatans.id')
                ->whereDate('trackings.tanggal', date('Y-m-d'))
                ->groupby('kecamatans.id')
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('kecamatans.nama_kecamatan as Kecamatan'), 
                         DB::raw('SUM(trackings.positif) as Positif'), 
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                ->groupBy('kecamatans.nama_kecamatan')
            ->get();

        $rest = [
            'status' => 200,
            'data' => [ 
                'Hari Ini' =>[$data_skrg],
                'Total' =>[$data]
            ],
            'message' => 'Data Kasus Kecamatan Ditampilkan'
        ];
        return response()->json($rest, 200);

    }

    public function showkecamatan($id)
    {
        $data_skrg = DB::table('trackings')
                ->select('positif', 'sembuh', 'meninggal')
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->join('kecamatans' ,'kelurahans.id_kecamatan', '=', 'kecamatans.id')
                ->where('kecamatans.id', $id)
                ->where('trackings.tanggal', date('Y-m-d'))
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('kecamatans.nama_kecamatan as Kecamatan'), 
                         DB::raw('SUM(trackings.positif) as positif'), 
                         DB::raw('SUM(trackings.meninggal) as meninggal'),
                         DB::raw('SUM(trackings.sembuh) as sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->join('kecamatans', 'kecamatans.id', '=', 'kelurahans.id_kecamatan')
                ->where('kecamatans.id', $id)
                ->groupBy('kecamatans.nama_kecamatan')
            ->get();
            
        $data_skrg = [
            'Positif' =>$data_skrg->sum('positif'),
            'Sembuh' =>$data_skrg->sum('sembuh'),
            'Meninggal' =>$data_skrg->sum('meninggal'),
        ];
        
        $data = [
            'Positif' =>$data->sum('positif'),
            'Sembuh' =>$data->sum('sembuh'),
            'Meninggal' =>$data->sum('meninggal'),
        ];
        
        $rest = [
            'status' => 200,
            'data' => [
                'Hari Ini' => $data_skrg,
                'Total' => $data
            ],
            'message' => 'Data Kasus Kecamatan Ditampilkan'
        ];
        
        return response()->json($rest, 200);
    }

    public function kelurahan(){
        $hariini = Carbon::now()->format('d-m-y'); 
        $data_skrg = DB::table('trackings')
                ->select(DB::raw('kelurahans.Id'),
                         DB::raw('kelurahans.Nama_kelurahan'),
                         DB::raw('SUM(trackings.positif) as Positif'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh'),
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('MAX(tanggal) as Tanggal'))
                         ->whereDay('tanggal', '=' , $hariini)
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->whereDate('trackings.tanggal', date('Y-m-d'))
                ->groupby('kelurahans.id')
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('kelurahans.nama_kelurahan as Kelurahan'), 
                         DB::raw('SUM(trackings.positif) as Positif'), 
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->groupBy('kelurahans.nama_kelurahan')
            ->get();

        $rest = [
            'status' => 200,
            'data' => [ 
                'Hari Ini' =>[$data_skrg],
                'Total' =>[$data]
            ],
            'message' => 'Data Kasus Kelurahan Ditampilkan'
        ];
        return response()->json($rest, 200);

    }

    public function showkelurahan($id)
    {
        $data_skrg = DB::table('trackings')
                ->select('positif', 'sembuh', 'meninggal')
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->join('kelurahans' ,'rws.id_kelurahan', '=', 'kelurahans.id')
                ->where('kelurahans.id', $id)
                ->where('trackings.tanggal', date('Y-m-d'))
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('kelurahans.nama_kelurahan as Kelurahan'), 
                         DB::raw('SUM(trackings.positif) as positif'), 
                         DB::raw('SUM(trackings.meninggal) as meninggal'),
                         DB::raw('SUM(trackings.sembuh) as sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->join('kelurahans', 'kelurahans.id', '=', 'rws.id_kelurahan')
                ->where('kelurahans.id', $id)
                ->groupBy('kelurahans.nama_kelurahan')
            ->get();
            
        $data_skrg = [
            'Positif' =>$data_skrg->sum('positif'),
            'Sembuh' =>$data_skrg->sum('sembuh'),
            'Meninggal' =>$data_skrg->sum('meninggal'),
        ];
        
        $data = [
            'Positif' =>$data->sum('positif'),
            'Sembuh' =>$data->sum('sembuh'),
            'Meninggal' =>$data->sum('meninggal'),
        ];
        
        $rest = [
            'status' => 200,
            'data' => [
                'Hari Ini' => $data_skrg,
                'Total' => $data
            ],
            'message' => 'Data Kasus Kelurahan Ditampilkan'
        ];
        
        return response()->json($rest, 200);
    }

    public function rw(){
        $hariini = Carbon::now()->format('d-m-y'); 
        $data_skrg = DB::table('trackings')
                ->select(DB::raw('rws.Id'),
                         DB::raw('rws.Nama_rw'),
                         DB::raw('SUM(trackings.positif) as Positif'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh'),
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('MAX(tanggal) as Tanggal'))
                         ->whereDay('tanggal', '=' , $hariini)
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->whereDate('trackings.tanggal', date('Y-m-d'))
                ->groupby('rws.id')
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('rws.nama_rw as Rw'), 
                         DB::raw('SUM(trackings.positif) as Positif'), 
                         DB::raw('SUM(trackings.meninggal) as Jumlah_Meninggal'),
                         DB::raw('SUM(trackings.sembuh) as Jumlah_Sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->groupBy('rws.nama_rw')
            ->get();

        $rest = [
            'status' => 200,
            'data' => [ 
                'Hari Ini' =>[$data_skrg],
                'Total' =>[$data]
            ],
            'message' => 'Data Kasus Rw Ditampilkan'
        ];
        return response()->json($rest, 200);

    }

    public function showrw($id)
    {
        $data_skrg = DB::table('trackings')
                ->select('positif', 'sembuh', 'meninggal')
                ->join('rws' ,'trackings.id_rw', '=', 'rws.id')
                ->where('rws.id', $id)
                ->where('trackings.tanggal', date('Y-m-d'))
                ->get();

        $data = DB::table('trackings')
                ->select(DB::raw('rws.nama_rw as Rw'), 
                         DB::raw('SUM(trackings.positif) as positif'), 
                         DB::raw('SUM(trackings.meninggal) as meninggal'),
                         DB::raw('SUM(trackings.sembuh) as sembuh')) 
                ->join('rws', 'rws.id', '=', 'trackings.id_rw')
                ->where('rws.id', $id)
                ->groupBy('rws.nama_rw')
            ->get();
            
        $data_skrg = [
            'Positif' =>$data_skrg->sum('positif'),
            'Sembuh' =>$data_skrg->sum('sembuh'),
            'Meninggal' =>$data_skrg->sum('meninggal'),
        ];
        
        $data = [
            'Positif' =>$data->sum('positif'),
            'Sembuh' =>$data->sum('sembuh'),
            'Meninggal' =>$data->sum('meninggal'),
        ];
        
        $rest = [
            'status' => 200,
            'data' => [
                'Hari Ini' => $data_skrg,
                'Total' => $data
            ],
            'message' => 'Data Kasus Rw Ditampilkan'
        ];
        
        return response()->json($rest, 200);
    }

}