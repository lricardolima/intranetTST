@extends('layouts.app')
    @section('title', 'Ouvidoria')
        @section('content')
            <div class="d-flex justify-content-center">
                <div class="col-10">
                    <div class="card-show mb-2">
                        <img class="card-img-top" src="{{asset("storage/sac/$sac->photo")}}" alt="">
                        <div class="card-body">
                        <h5 class="card-title">{{$sac->title}}</h5>
                        <p class="card-text">{!!$sac->description!!}</p>
                        <p class="card-text"><small class="text-muted">Responsável: {{$sac->responsible}}</small></p>
                    </div>
                 </div>
            </div>
        @endsection
