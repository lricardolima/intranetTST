@extends('layouts.app')
@section('title', 'Faturamento')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Tecnologia')
            <a href="{{route('revenues.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="training">
            <div class="row">
                <div class="training-title col-sm-12 my-5">
                    <h1>Faturamento</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="training">
            <div class="row">
                @forelse ($revenues as $revenue)
                @if (($revenue->type) === 'Avançado')
                @can('Setor Tecnologia')
                <div class="carde col-sm-4">
                    <div id="training">
                        <a class="mt-2" id="" href="{{url($revenue->link)}}">
                            @if($revenue->photo)
                            <img class="img-fluid" src="{{asset("storage/revenues/$revenue->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$revenue->title}}</h4>
                                <p class="carde-text">{!! $revenue->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $revenue->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('revenues.edit' , ['revenue' => $revenue -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                        <form action="{{ route('revenues.destroy' , ['revenue' => $revenue -> id]) }}" method="post">
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
                @elseif(($revenue->type) === 'Comum')
                    <div class="carde col-sm-4">
                        <div id="training">
                            <a class="mt-2" id="" href="{{url($revenue->link)}}">
                                @if($revenue->photo)
                                <img class="img-fluid" src="{{asset("storage/revenues/$revenue->photo")}}" alt="">
                                @else
                                <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                                @endif
                                <div class="block">
                                    <h4 class="carde-title-index">{{$revenue->title}}</h4>
                                    <p class="carde-text">{!! $revenue->description !!}</p>
                                    <p class="carde-text-small"><small class="text-muted">Responsável: {{ $revenue->responsible }}</small></p>
                                </div>
                            </a>
                        </div>
                        <div class="d-flex justify-content-end mb-2">
                            @can('Editar Setor Tecnologia')
                                <a class=" btn mx-2" id="btn-default" href="{{ route('revenues.edit' , ['revenue' => $revenue -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                            @endcan
                            @can('Excluir Setor Tecnologia')
                            <form action="{{ route('revenues.destroy' , ['revenue' => $revenue -> id]) }}" method="post">
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
            {{ $revenues->links() }}
         </div>
    </div>
@endsection








