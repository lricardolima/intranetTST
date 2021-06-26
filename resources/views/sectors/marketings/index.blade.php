@extends('layouts.app')
@section('title', 'Marketing')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Marketing')
            <a href="{{route('marketing.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Marketing</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector-body">
            <div class="row">
                @forelse ($marketings as $marketing)
                @if (($marketing->type) === 'Avançado')
                @can('Setor Marketing')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($marketing->link)}}">
                            @if($marketing->photo)
                            <img class="img-fluid" src="{{asset("storage/marketing/$marketing->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$marketing->title}}</h4>
                                <p class="carde-text">{!! $marketing->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $marketing->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Marketing')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('marketing.edit' , ['marketing' => $marketing -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                         @endcan
                         @can('Excluir Setor Marketing')
                         <form action="{{ route('marketing.destroy' , ['marketing' => $marketing -> id]) }}" method="post">
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
                @elseif(($marketing->type) === 'Comum')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($marketing->link)}}">
                            @if($marketing->photo)
                            <img class="img-fluid" src="{{asset("storage/marketing/$marketing->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$marketing->title}}</h4>
                                <p class="carde-text">{!! $marketing->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $marketing->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Marketing')
                        <a class=" btn mx-2" id="btn-default" href="{{ route('marketing.edit' , ['marketing' => $marketing -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                     @endcan
                     @can('Excluir Setor Marketing')
                        <form action="{{ route('marketing.destroy' , ['marketing' => $marketing -> id]) }}" method="post">
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
            {{ $marketings->links() }}
         </div>
    </div>
@endsection








