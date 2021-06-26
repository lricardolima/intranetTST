@extends('layouts.app')
@section('title', 'Departamento Pessoal')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Pessoal')
            <a href="{{route('personalDepartment.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="sector">
            <div class="row">
                <div class="sector-title col-sm-12 my-5">
                    <h1>Departamento Pessoal</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="sector">
            <div class="row">
                @forelse ($personalDepartments as $personalDepartment)
                @if (($personalDepartment->type) === 'Avançado')
                @can('Setor Pessoal')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($personalDepartment->link)}}">
                            @if($personalDepartment->photo)
                            <img class="img-fluid" src="{{asset("storage/personalDepartment/$personalDepartment->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$personalDepartment->title}}</h4>
                                <p class="carde-text">{!! $personalDepartment->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $personalDepartment->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Pessoal')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('personalDepartment.edit' , ['personalDepartment' => $personalDepartment -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Pessoal')
                        <form action="{{ route('personalDepartment.destroy' , ['personalDepartment' => $personalDepartment -> id]) }}" method="post">
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
                @elseif(($personalDepartment->type) === 'Comum')
                <div class="carde col-sm-4">
                    <div id="sector">
                        <a class="mt-2" id="" href="{{url($personalDepartment->link)}}">
                            @if($personalDepartment->photo)
                            <img class="img-fluid" src="{{asset("storage/personalDepartment/$personalDepartment->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$personalDepartment->title}}</h4>
                                <p class="carde-text">{!! $personalDepartment->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $personalDepartment->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Pessoal')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('personalDepartment.edit' , ['personalDepartment' => $personalDepartment -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Pessoal')
                        <form action="{{ route('personalDepartment.destroy' , ['personalDepartment' => $personalDepartment -> id]) }}" method="post">
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
            {{ $personalDepartments->links() }}
         </div>
    </div>
@endsection








