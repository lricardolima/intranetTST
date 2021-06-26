@extends('layouts.app')
@section('title', 'Qualidade')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Qualidade')
            <a href="{{route('quality.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Qualidade</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector-body">
            <div class="row">
                @forelse ($qualities as $quality)
                @if (($quality->type) === 'Avançado')
                @can('Setor Qualidade')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($quality->link)}}">
                            @if($quality->photo)
                            <img class="img-fluid" src="{{url("storage/quality/$quality->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$quality->title}}</h4>
                                <p class="carde-text">{!! $quality->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $quality->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Qualidade')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('quality.edit' , ['quality' => $quality -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Qualidade')
                        <form action="{{ route('quality.destroy' , ['quality' => $quality -> id]) }}" method="post">
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
                @elseif(($quality->type) === 'Comum')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($quality->link)}}">
                            @if($quality->photo)
                            <img class="img-fluid" src="{{url("storage/quality/$quality->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$quality->title}}</h4>
                                <p class="carde-text">{!! $quality->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $quality->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Qualidade')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('quality.edit' , ['quality' => $quality -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Qualidade')
                        <form action="{{ route('quality.destroy' , ['quality' => $quality -> id]) }}" method="post">
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
            <h4 class="carde-title">Não existe Informações cadastrados</h4>
            @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $qualities->links() }}
         </div>
    </div>
@endsection








