@extends('layouts.master.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Tambah Provinsi</div>
                <div class="card-body">
                <form action="{{route('provinsi.store')}}" method="POST">
                   @csrf
                    <div class="form-group">
                        <label>Kode Provinsi</label>
                        <input type="text" name="kode_provinsi" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Provinsi</label>
                        <input type="text" name="nama_provinsi" class="form-control" required>
                    </div>
                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection