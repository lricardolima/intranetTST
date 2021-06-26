@extends('layouts.app')
@section('title', 'Tecnologia')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Tecnologia')
            <a href="{{route('technology.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Tecnologia</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector-body">
            <div class="row">
                @forelse ($technologies as $technology)
                @if (($technology->type) === 'Avançado')
                @can('Setor Tecnologia')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($technology->link)}}">
                            @if($technology->photo)
                            <img class="img-fluid" src="{{asset("storage/technology/$technology->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$technology->title}}</h4>
                                <p class="carde-text">{!! $technology->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $technology->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('technology.edit' , ['technology' => $technology -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                        <form action="{{ route('technology.destroy' , ['technology' => $technology -> id]) }}" method="post">
                            @csrf
                             @method('delete')
                            <button class="btn" id="btn-default">
                             <a><i class="fa fa-trash" aria-hidden="true"></i></a> Excluir
                            </button>
                         </form>
                        @endcan
                   </div>
                   </div>
                @endcan
                @elseif(($technology->type) === 'Comum')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($technology->link)}}">
                            @if($technology->photo)
                            <img class="img-fluid" src="{{asset("storage/technology/$technology->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$technology->title}}</h4>
                                <p class="carde-text">{!! $technology->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $technology->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                        <a class=" btn mx-2" id="btn-default" href="{{ route('technology.edit' , ['technology' => $technology -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                        <form action="{{ route('technology.destroy' , ['technology' => $technology -> id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn" id="btn-default">
                            <a><i class="fa fa-trash" aria-hidden="true"></i></a> Excluir
                            </button>
                        </form>
                        @endcan
                   </div>
                   </div>
                @endif
            @empty
            <h4 class="card-title">Não existe Informações cadastrados</h4>
            @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $technologies->links() }}
         </div>
    </div>
@endsection








