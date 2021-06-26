@extends('layouts.app')
@section('title', 'Lista de Treinamentos')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        <div class="contaniner-sm" id="training">
            <div class="row">
                <div class="training-title col-sm-12 my-5">
                    <h1>Lista de Treinamentos</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="training">
            <div class="row">
                @forelse ($trainings as $training)
                <div class="carde col-sm-3">
                    <div id="training">
                        <a class="mt-2" id="" href="{{url($training->url)}}">
                            @if($training->photo)
                            <img class="img-fluid" src="{{asset("storage/training/$training->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title">{{$training->name}}</h4>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
            <h4 class="card-title">Não existe Informações cadastrados</h4>
            @endforelse
            <div class="row d-flex justify-content-end col-sm-12 btn-end">
                <a href="{{route('training.index')}}" class="btn mt-3" id="button-default">Todos treinamentos</a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
