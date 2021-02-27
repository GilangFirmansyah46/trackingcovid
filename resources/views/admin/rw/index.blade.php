@extends('layouts.master.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                    <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Rw
                        <a href=" {{route('rw.create')}} " class="btn btn-primary" style="float: right;">Tambah Data</a>
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Rw</th>
                                    <th>Kelurahan</th>
                                    <th>
                                        <center>
                                            Aksi
                                        </center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($rw as $item)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td> {{$item->nama_rw}} </td>
                                        <td> {{$item->kelurahan->nama_kelurahan}} </td>
                                        <td>
                                            <center>
                                                <form action="{{ route('rw.destroy', $item->id) }}" method="post">
                                                    @csrf
                                                    @method('Delete')
                                                    <a class="btn btn-info" href=" {{route('rw.show', $item->id)}} ">
                                                        Show
                                                    </a> 
                                                    <a class="btn btn-success" href=" {{route('rw.edit', $item->id)}} ">
                                                        Edit
                                                    </a> 
                                                    <button type="submit" onclick="return confirm('Apakah anda yakin?');" class="btn btn-danger">Delete</button>
                                                </form>
                                            </center>
                                        </td>
                                    </tr>
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