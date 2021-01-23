@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Provinsi</div>

                <div class="card-body">
                <form action="{{route('provinsi.update',$provinsi->id)}}" method="POST">
                   @csrf
                   @method('PATCH')
                    <div class="form-group">
                        <label>Kode provinsi</label>
                        <input type="text" name="kode_provinsi" value="{{$provinsi->provinsi}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Provinsi</label>
                        <input type="text" name="nama_provinsi" value="{{$provinsi->provinsi}}" class="form-control" required>
                    </div>


                    <div class="form-group">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection