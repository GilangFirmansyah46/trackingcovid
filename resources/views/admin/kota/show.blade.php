@extends('layouts.master.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show Provinsi</div>
                <div class="card-body">
                    <div class="form-group">
                    <label>Kode Provinsi</label>
                    <input type="text" name="kode_kota" value="{{$kota->kode_kota}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                    <label>Nama Kota</label>
                    <input type="text" name="kode_provinsi" value="{{$kota->nama_kota}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">Asal Provinsi</label>
                        <input type="text" name="id_provinsi" class="form-control" value="{{$kota->provinsi->nama_provinsi}}" readonly>
                    </div>
                    <div class="form-group">
                    <a href="{{url()->previous()}}" class="btn btn-primary">Kembali</a>
                    </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection