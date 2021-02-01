@extends('layouts.master.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Daftar Kelurahan
                <a href="{{route('kelurahan.create')}}" class="btn btn-primary float-right">
                Tambah Data</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Kelurahan</th>
                                    <th>Nama kecamatan</th>
                                    <th colspan="3"><center>Aksi</center></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($kelurahan as $data)
                                <form action="{{route('kelurahan.destroy',$data->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$data->nama_kelurahan}}</td>
                                        <td>{{$data->kecamatan->nama_kecamatan}}</td>
                                        <td>
                                            <a href="{{route('kelurahan.show',$data->id)}}" class="btn btn-info">Show</a>
                                        </td>
                                        <td>
                                            <a href="{{route('kelurahan.edit',$data->id)}}" class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <button type="submit" onclick="return confirm('Apakah anda yakin?');" class="btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                </form>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 