<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index()
    {
        $positif = DB::table('rws')
        ->select('trackings.positif',
        'trackings.sembuh', 'trackings.meninggal')
        ->join('trackings','rws.id','=','trackings.id_rw')
        ->sum('trackings.positif'); 
    $sembuh = DB::table('rws')
        ->select('trackings.positif',
        'trackings.sembuh','trackings.meninggal')
        ->join('trackings','rws.id','=','trackings.id_rw')
        ->sum('trackings.sembuh');
    $meninggal = DB::table('rws')
        ->select('trackings.positif',
        'trackings.sembuh','trackings.meninggal')
        ->join('trackings','rws.id','=','trackings.id_rw')
        ->sum('trackings.meninggal');
    $globalpositif = file_get_contents('https://api.kawalcorona.com/positif');
    $posglobal = json_decode($globalpositif, TRUE);
    $globalsembuh= file_get_contents('https://api.kawalcorona.com/sembuh');
    $semglobal = json_decode($globalsembuh, TRUE);
    $globalmeninggal = file_get_contents('https://api.kawalcorona.com/meninggal');
    $menglobal = json_decode($globalmeninggal, TRUE);
    // Date
    $tanggal = Carbon::now()->format('D d-M-Y h:i:s');

    // Table Provinsi
    $tampil = DB::table('provinsis')
              ->join('kotas','kotas.id_provinsi','=','provinsis.id')
              ->join('kecamatans','kecamatans.id_kota','=','kotas.id')
              ->join('kelurahans','kelurahans.id_kecamatan','=','kecamatans.id')
              ->join('rws','rws.id_kelurahan','=','kelurahans.id')
              ->join('trackings','trackings.id_rw','=','rws.id')
              ->select('nama_provinsi',
                      DB::raw('SUM(trackings.positif) as Positif'),
                      DB::raw('SUM(trackings.sembuh) as Sembuh'),
                      DB::raw('SUM(trackings.meninggal) as Meninggal'))
              ->groupBy('nama_provinsi')->orderBy('nama_provinsi','ASC')
              ->get();

    // Table Global
    $datadunia= file_get_contents("https://api.kawalcorona.com/");
    $dunia = json_decode($datadunia, TRUE);
        
    return view('frontend.index',compact('positif','sembuh','meninggal','posglobal','semglobal','menglobal', 'tanggal','tampil','dunia'));
    }
        
}