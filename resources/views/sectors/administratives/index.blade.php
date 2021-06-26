@extends('layouts.app')
@section('title', 'Administrativo')
@section('content')
<br>
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Tecnologia')
            <a href="{{route('administrative.create')}}" class="btn mt-5 mr-2" id="button-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="administrative">
            <div class="row">
                <div class="administrative-title col-sm-12 my-5">
                    <h1>Setores Administrativos</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="administrative-body">
            <div class="row">
                @forelse ($administratives as $administrative)
                <div class="carde col-sm-3">
                    <div id="administrative">
                        <a class="mt-2" id="" href="{{url($administrative->url)}}">
                            @if($administrative->image)
                            <img class="img-fluid" src="{{url("storage/administrative/$administrative->image")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                              
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end btn-default">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('administrative.edit' , ['administrative' => $administrative -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                            <form action="{{ route('administrative.destroy' , ['administrative' => $administrative -> id]) }}" method="post">
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
            {{ $administratives->links() }}
         </div>
    </div>
</div>
@endsection








