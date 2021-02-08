@extends('layouts.master.index')
@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('tracking.store')}}" class="form-horizontal m-t-30" method="post">
                @csrf
                @livewireScripts
                @livewire('livewire')
                @livewireStyles
                <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection