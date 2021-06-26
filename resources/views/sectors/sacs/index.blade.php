@extends('layouts.app')
@section('title', 'Ouvidoria')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Ouvidoria')
            <a href="{{route('sac.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Ouvidoria</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector">
            <div class="row">
                @forelse ($sacs as $sac)
                @if (($sac->type) === 'Avançado')
                @can('Setor Ouvidoria')
                <div class="carde col-sm-3">
                    <div id="sac">
                        <a class="mt-2" id="" href="{{url($sac->link)}}">
                            @if($sac->photo)
                            <img class="img-fluid" src="{{asset("storage/sac/$sac->photo")}}" alt="carde image cap">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$sac->title}}</h4>
                                <p class="carde-text">{!! $sac->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $sac->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Ouvidoria')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('sac.edit' , ['sac' => $sac -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Ouvidoria')
                        <form action="{{ route('sac.destroy' , ['sac' => $sac -> id]) }}" method="post">
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
                @elseif(($sac->type) === 'Comum')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($sac->link)}}">
                            @if($sac->photo)
                            <img class="img-fluid" src="{{asset("storage/sac/$sac->photo")}}" alt="carde image cap">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$sac->title}}</h4>
                                <p class="carde-text">{!! $sac->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $sac->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Ouvidoria')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('sac.edit' , ['sac' => $sac -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Ouvidoria')
                        <form action="{{ route('sac.destroy' , ['sac' => $sac -> id]) }}" method="post">
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
            {{ $sacs->links() }}
         </div>
    </div>
@endsection








