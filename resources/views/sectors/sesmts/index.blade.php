@extends('layouts.app')
@section('title', 'Sesmt')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Sesmt')
            <a href="{{route('sesmt.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Sesmt</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector-body">
            <div class="row">
                @forelse ($sesmts as $sesmt)
                @if (($sesmt->type) === 'Avançado')
                @can('Setor Sesmt')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($sesmt->link)}}">
                            @if($sesmt->photo)
                            <img class="img-fluid" src="{{asset("storage/sesmt/$sesmt->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$sesmt->title}}</h4>
                                <p class="carde-text">{!! $sesmt->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $sesmt->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Sesmt')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('sesmt.edit' , ['sesmt' => $sesmt -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Sesmt')
                        <form action="{{ route('sesmt.destroy' , ['sesmt' => $sesmt -> id]) }}" method="post">
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
                @elseif(($sesmt->type) === 'Comum')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($sesmt->link)}}">
                            @if($sesmt->photo)
                            <img class="img-fluid" src="{{asset("storage/sesmt/$sesmt->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$sesmt->title}}</h4>
                                <p class="carde-text">{!! $sesmt->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $sesmt->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Sesmt')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('sesmt.edit' , ['sesmt' => $sesmt -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Sesmt')
                        <form action="{{ route('sesmt.destroy' , ['sesmt' => $sesmt -> id]) }}" method="post">
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
            {{ $sesmts->links() }}
         </div>
    </div>
@endsection








