@extends('layouts.app')
@section('title', 'Educação Permanente')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Educação Permanente')
            <a href="{{route('permanentEducation.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Educação Permanente</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector-body">
            <div class="row">
                @forelse ($permanentsEducation as $permanentEducation)
                @if (($permanentEducation->type) === 'Avançado')
                @can('Educação Permanente')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($permanentEducation->link)}}">
                            @if($permanentEducation->photo)
                            <img class="img-fluid" src="{{asset("storage/permanentEducation/$permanentEducation->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$permanentEducation->title}}</h4>
                                <p class="carde-text">{!! $permanentEducation->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $permanentEducation->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Educação Permanente')
                            <a class=" btn mt-2 mr-2" id="btn-default" href="{{ route('permanentEducation.edit' , ['permanentEducation' => $permanentEducation -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Educação Permanente')
                        <form action="{{ route('permanentEducation.destroy' , ['permanentEducation' => $permanentEducation -> id]) }}" method="post">
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
                @elseif(($permanentEducation->type) === 'Comum')
                <div class="carde col-sm-3">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($permanentEducation->link)}}">
                            @if($permanentEducation->photo)
                            <img class="img-fluid" src="{{asset("storage/permanentEducation/$permanentEducation->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$permanentEducation->title}}</h4>
                                <p class="carde-text">{!! $permanentEducation->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $permanentEducation->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Educação Permanente')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('permanentEducation.edit' , ['permanentEducation' => $permanentEducation -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Educação Permanente')
                        <form action="{{ route('permanentEducation.destroy' , ['permanentEducation' => $permanentEducation -> id]) }}" method="post">
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
            {{ $permanentsEducation->links() }}
         </div>
    </div>
@endsection








