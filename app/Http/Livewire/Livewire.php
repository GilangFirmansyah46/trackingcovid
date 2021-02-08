<?php

namespace App\Http\Livewire;

use App\Models\Rw;
use App\Models\Kelurahan;
use App\Models\Kecamatan;
use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\Tracking;
use Livewire\Component;

class Livewire extends Component
{
    public $provinsis;
    public $kotas;
    public $kecamatans;
    public $kelurahans;
    public $rws;
    public $idk;
    public $tracking;

    public $selectedProvinsi = null;
    public $selectedKota = null;
    public $selectedKecamatan = null;
    public $selectedKelurahan = null;
    public $selectedRw = null;

    public function mount($selectedRw = null, $idk = null)
    {
        $this->provinsis = Provinsi::all();
        $this->kotas= Kota::whereHas('provinsi', function ($query) {
            $query->whereId(request()->input('id_provinsi', 0));
        })->pluck('nama_kota', 'id');
        $this->kecamatans = Kecamatan::whereHas('kota', function ($query) {
            $query->whereId(request()->input('id_kota', 0));
        })->pluck('nama_kecamatan', 'id');
        $this->kelurahans = Kelurahan::whereHas('kecamatan', function ($query) {
            $query->whereId(request()->input('id_kecamatan', 0));
        })->pluck('nama_kelurahan', 'id');
        $this->rws = Rw::whereHas('kelurahan', function ($query) {
            $query->whereId(request()->input('id_kelurahan', 0));
        })->pluck('nama_rw', 'id');
        $this->selectedRw = $selectedRw;
        $this->idk = $idk;
        if (!is_null($idk)) {
            $this->tracking = Tracking::findOrFail($idk);
        }

        if (!is_null($selectedRw)) {
            $rw = Rw::with('kelurahan.kecamatan.kota.provinsi')->find($selectedRw);
            if ($rw) {
                $this->rws = Rw::where('id_kelurahan', $rw->id_kelurahan)->get();
                $this->kelurahans = Kelurahan::where('id_kecamatan', $rw->kelurahan->id_kecamatan)->get();
                $this->kecamatans = Kecamatan::where('id_kota', $rw->kelurahan->kecamatan->id_kota)->get();
                $this->kotas = Kota::where('id_provinsi', $rw->kelurahan->kecamatan->kota->id_provinsi)->get();
                $this->selectedProvinsi =$rw->kelurahan->kecamatan->kota->id_provinsi;
                $this->selectedKota = $rw->kelurahan->kecamatan->id_kota;
                $this->selectedKecamatan = $rw->kelurahan->id_kecamatan;
                $this->selectedKelurahan = $rw->id_kelurahan;
            }
        }
    }

    public function render()
    {
        return view('livewire.livewire');
    }

    public function updatedSelectedProvinsi($provinsi)
    {
        $this->kotas = Kota::where('id_provinsi', $provinsi)->get();
        $this->selectedKecamatan = NULL;
        $this->selectedkelurahan = NULL;
        $this->selectedRw = NULL;
    }
    public function updatedSelectedKota($kota)
    {
        $this->kecamatans = Kecamatan::where('id_kota', $kota)->get();
        $this->selectedkelurahan = NULL;
        $this->selectedRw = NULL;
    }

    public function updatedSelectedKecamatan($kecamatan)
    {
        $this->kelurahans = kelurahan::where('id_kecamatan', $kecamatan)->get();
        $this->selectedRw = NULL;
    }
    public function updatedSelectedkelurahan($kelurahan)
    {
        if (!is_null($kelurahan)) {
            $this->rws = Rw::where('id_kelurahan', $kelurahan)->get();
        }else{
            $this->selectedRw = NULL;
        }
    }

}