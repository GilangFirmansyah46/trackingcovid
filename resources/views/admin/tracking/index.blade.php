@extends('layouts.master.index')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
        @if (session('message'))
                <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('message') }}
                </div>
            @elseif(session('message1'))
                <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ session('message1') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Data Tracking') }}
                <a href="{{route('tracking.create')}}" class="btn btn-primary float-right">Tambah Data</a>
            </div>

            <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr class="bg-teal">
                      <th scope="col">No</th>
                                            <th scope="col"><center>Lokasi</center></th>
                                            <th scope="col"><center>RW</center></th>
                                            <th scope="col"><center>Positif</center></th>
                                            <th scope="col"><center>Sembuh</center></th>
                                            <th scope="col"><center>Meninggal</center></th>
                                            <th scope="col"><center>Tanggal</center></th>
                                            <th scope="col"><center>Action</center></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php $no=1;
                                    @endphp
                                    @foreach($tracking as $data)

                                        <tr>
                                            <th scope="row"><center>{{$no++}}</center></th>
                                            <td><center>Kelurahan : {{$data->rw->kelurahan->nama_kelurahan}}<br>
                                            Kecamatan : {{$data->rw->kelurahan->kecamatan->nama_kecamatan}}<br>
                                            Kota : {{$data->rw->kelurahan->kecamatan->kota->nama_kota}}<br>
                                            Provinsi : {{$data->rw->kelurahan->kecamatan->kota->provinsi->nama_provinsi}}</center></td>
                                            <td><center>{{$data->rw->nama_rw}}</center></td>
                                            <td><center>{{$data->jumlah_positif}}</center></td>
                                            <td><center>{{$data->jumlah_sembuh}}</center></td>
                                            <td><center>{{$data->jumlah_meninggal}}</center></td>
                                            <td><center>{{$data->tanggal}}</center></td>
                                            <td>
                                            <form action="{{route('tracking.destroy',$data->id)}}"  method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <center>
                                            <a href="{{route('tracking.edit',$data->id)}}" class="btn btn-success">EDIT<i></a></i>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')">DELETE<i class="fa fa-trash-alt">
                                            </form>
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
</div>
@endsection