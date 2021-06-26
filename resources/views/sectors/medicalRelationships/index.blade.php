@extends('layouts.app')
@section('title', 'Relacionamento Médico')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Relacionamento Medico')
            <a href="{{route('medicalRelationship.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Relacionamento Médico</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector">
            <div class="row">
                @forelse ($medicalRelationships as $medicalRelationship)
                @if (($medicalRelationship->type) === 'Avançado')
                @can('Setor Relacionamento Medico')
                <div class="carde col-sm-3">
                    <div id="medicalRelationship">
                        <a class="mt-2" id="" href="{{url($medicalRelationship->link)}}">
                            @if($medicalRelationship->photo)
                            <img class="img-fluid" src="{{asset("storage/medicalRelationship/$medicalRelationship->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$medicalRelationship->title}}</h4>
                                <p class="carde-text">{!! $medicalRelationship->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $medicalRelationship->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Relacionamento Medico')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('medicalRelationship.edit' , ['medicalRelationship' => $medicalRelationship -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Relacionamento Medico')
                        <form action="{{ route('medicalRelationship.destroy' , ['medicalRelationship' => $medicalRelationship -> id]) }}" method="post">
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
                @elseif(($medicalRelationship->type) === 'Comum')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($medicalRelationship->link)}}">
                            @if($medicalRelationship->photo)
                            <img class="img-fluid" src="{{asset("storage/medicalRelationship/$medicalRelationship->photo")}}" alt="carde image cap">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$medicalRelationship->title}}</h4>
                                <p class="carde-text">{!! $medicalRelationship->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $medicalRelationship->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Relacionamento Medico')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('medicalRelationship.edit' , ['medicalRelationship' => $medicalRelationship -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Relacionamento Medico')
                        <form action="{{ route('medicalRelationship.destroy' , ['medicalRelationship' => $medicalRelationship -> id]) }}" method="post">
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
            {{ $medicalRelationships->links() }}
         </div>
    </div>
@endsection








