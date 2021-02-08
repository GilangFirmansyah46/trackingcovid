@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{route('tracking.update',$tracking->id)}}"  method="POST">
                        @csrf
                        @method('PUT')
                        @livewireScripts
                        @livewire('livewire',['selectedRw' => $tracking->id_rw,'idk' => $tracking->id])
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