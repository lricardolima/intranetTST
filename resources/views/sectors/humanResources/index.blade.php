@extends('layouts.app')
@section('title', 'Recursos Humanos')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Recursos Humanos')
            <a href="{{route('humanResource.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Recursos Humanos</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector">
            <div class="row">
                @forelse ($humanResources as $humanResource)
                @if (($humanResource->type) === 'Avançado')
                @can('Setor Recursos Humanos')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($humanResource->link)}}">
                            @if($humanResource->photo)
                            <img class="img-fluid" src="{{asset("storage/humanResource/$humanResource->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$humanResource->title}}</h4>
                                <p class="carde-text">{!! $humanResource->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $humanResource->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Recursos Humanos')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('humanResource.edit' , ['humanResource' => $humanResource -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Recursos Humanos')
                            <form action="{{ route('humanResource.destroy' , ['humanResource' => $humanResource -> id]) }}" method="post">
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
                @elseif(($humanResource->type) === 'Comum')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($humanResource->link)}}">
                            @if($humanResource->photo)
                            <img class="img-fluid" src="{{asset("storage/humanResource/$humanResource->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$humanResource->title}}</h4>
                                <p class="carde-text">{!! $humanResource->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $humanResource->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Recursos Humanos')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('humanResource.edit' , ['humanResource' => $humanResource -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Recursos Humanos')
                            <form action="{{ route('humanResource.destroy' , ['humanResource' => $humanResource -> id]) }}" method="post">
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
            {{ $humanResources->links() }}
         </div>
    </div>
@endsection








