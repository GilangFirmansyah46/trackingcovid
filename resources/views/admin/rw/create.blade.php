@extends('layouts.master.index')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Data Rw') }}</div>

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
                    
                    <form action="{{ route('rw.store')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="exampleInputEmail1" class="form-label">Rw</label>
                          <input type="text" name="nama_rw" class="form-control" id="exampleInputEmail1" 
                          aria-describedby="emailHelp">
                          <div id="emailHelp" class="form-text"></div>
                        </div>

                        <div class="form-group">
                            <label for="">Asal Kelurahan</label>
                            <select name="id_kelurahan" class="form-control" required>
                                @foreach($kelurahan as $data)
                                    <option value="{{$data->id}}">{{$data->nama_kelurahan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection