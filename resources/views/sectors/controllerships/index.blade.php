@extends('layouts.app')
@section('title', 'Controladoria')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Tecnologia')
            <a href="{{route('controllership.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Controladoria</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector">
            <div class="row">
                @forelse ($controllerships as $controllership)
                @if (($controllership->type) === 'Avançado')
                @can('Setor Tecnologia')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($controllership->link)}}">
                            @if($controllership->photo)
                            <img class="img-fluid" src="{{asset("storage/controllership/$controllership->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sector/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$controllership->title}}</h4>
                                <p class="carde-text">{!! $controllership->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $controllership->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mt-2 mr-2" id="btn-default" href="{{ route('controllership.edit' , ['controllership' => $controllership -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                        <form action="{{ route('controllership.destroy' , ['controllership' => $controllership -> id]) }}" method="post">
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
                @elseif(($controllership->type) === 'Comum')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($controllership->link)}}">
                            @if($controllership->photo)
                            <img class="img-fluid" src="{{asset("storage/controllership/$controllership->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sector/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$controllership->title}}</h4>
                                <p class="carde-text">{!! $controllership->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $controllership->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('controllership.edit' , ['controllership' => $controllership -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                        <form action="{{ route('controllership.destroy' , ['controllership' => $controllership -> id]) }}" method="post">
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
            {{ $controllerships->links() }}
         </div>
    </div>
@endsection








