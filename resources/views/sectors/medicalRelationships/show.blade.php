@extends('layouts.app')
    @section('title', 'Relacionamento Médico')
        @section('content')
            <div class="d-flex justify-content-center">
                <div class="col-10">
                    <div class="card-show mb-2">
                        <img class="card-img-top" src="{{asset("storage/medicalRelationship/$medicalRelationship->photo")}}" alt="">
                        <div class="card-body">
                        <h5 class="card-title">{{$medicalRelationship->title}}</h5>
                        <p class="card-text">{!!$medicalRelationship->description!!}</p>
                        <p class="card-text"><small class="text-muted">Responsável: {{$medicalRelationship->responsible}}</small></p>
                    </div>
                 </div>
            </div>
        @endsection
