@extends('layouts.app')
@section('title', 'Assistencial')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Tecnologia')
            <a href="{{route('assistance.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="assistance">
            <div class="row">
                <div class="assistance-title col-sm-12 my-5">
                    <h1>Setores Assistenciais</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="assistance">
            <div class="row">
                @forelse ($assistances as $assistance)
                <div class="carde col-sm-3">
                    <div id="assistance">
                        <a class="mt-2" id="" href="{{url($assistance->url)}}">
                            @if($assistance->image)
                            <img class="img-fluid" src="{{url("storage/assistance/$assistance->image")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('assistance.edit' , ['assistance' => $assistance -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                            <form action="{{ route('assistance.destroy' , ['assistance' => $assistance -> id]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn" id="btn-default">
                                <a><i class="fa fa-trash" aria-hidden="true"></i></a> Excluir
                                </button>
                            </form>
                        @endcan
                   </div>
                </div>
            @empty
            <h4 class="card-title">Não existe Informações cadastrados</h4>
            @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $assistances->links() }}
         </div>
    </div>
@endsection








