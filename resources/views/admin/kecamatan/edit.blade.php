@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Kecamatan</div>

                <div class="card-body">
                {{-- menampilkan error validasi --}}
                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                    
                    <form action="{{ route('kecamatan.update', $kecamatan->id)}}" method="POST" >
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                          <label for="exampleInputPassword1" class="form-label">Nama Kecamatan</label>
                          <input type="text" name="nama_kecamatan" value="{{$kecamatan->nama_kecamatan}}" class="form-control" id="exampleInputPassword1">
                        </div>
                        
                        <div class="form-group">
                            <label for="">Asal Kota</label>
                            <select name="id_kota" class="form-control" required>
                                @foreach($kota as $data)
                                <option value="{{$data->id}}"
                                    {{$data->id == $kecamatan->id_kota ? "selected":""}}>{{$data->nama_kota}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection