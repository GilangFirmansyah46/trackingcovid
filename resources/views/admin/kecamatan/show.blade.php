@extends('layouts.master.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Show kecamatan</div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Kecamatan</label>
                        <input type="text" name="nama_kecamatan" value="{{$kecamatan->nama_kecamatan}}" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Kota</label>
                        <input type="text" name="id_kota" class="form-control" value="{{$kecamatan->kota->nama_kota}}" class="form-control" readonly>
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