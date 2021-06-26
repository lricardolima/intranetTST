@extends('layouts.app')
    @section('title', 'Educação Permanente')
        @section('content')
            <div class="d-flex justify-content-center">
                <div class="col-10">
                    <div class="card-show mb-2">
                        <img class="card-img-top" src="{{asset("storage/permanentEducation/$permanentEducation->photo")}}" alt="">
                        <div class="card-body">
                        <h5 class="card-title">{{$permanentEducation->title}}</h5>
                        <p class="card-text">{!!$permanentEducation->description!!}</p>
                        <p class="card-text"><small class="text-muted">Responsável: {{$permanentEducation->responsible}}</small></p>
                    </div>
                 </div>
            </div>
        @endsection
