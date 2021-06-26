@extends('layouts.app')
@section('title', 'Carrousel')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Carousel')
            <a href="{{route('carousel.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Adicionar Carrousel</a>
        @endcan
        <div class="carde-body">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
            @if($errors)
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger mt-4" role="alert">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
        <div class="contaniner-sm" id="carousel">
            <div class="row">
                <div class="carousel-title col-sm-12 my-5">
                    <h1>Carrousel</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="carousel">
            <div class="row">
                @forelse ($carousels as $carousel)
               <div class="carde col-sm-3">
                <div id="carousel">
                        <img class="img-fluid" src="{{asset("storage/carousel/$carousel->photo")}}" alt="carde image cap">
                </div>
                <div class="d-flex justify-content-end mb-2">
                    @can('Editar Carousel')
                        <a class=" btn mx-2" id="btn-default" href="{{ route('carousel.edit' , ['carousel' => $carousel -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                    @endcan
                    @can('Excluir Carousel')
                    <form action="{{ route('carousel.destroy' , ['carousel' => $carousel -> id]) }}" method="post">
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
            <h4 class="carde-title">Não existe setores cadastrados</h4>
            @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            {{ $carousels->links() }}
         </div>
    </div>
@endsection








