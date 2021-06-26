@extends('layouts.app')
@section('title', 'Atendimento')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        @can('Cadastrar Setor Tecnologia')
            <a href="{{route('attendance.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo</a>
        @endcan
        <div class="contaniner-sm" id="training">
            <div class="row">
                <div class="training-title col-sm-12 my-5">
                    <h1>Atendimento</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="training-body">
            <div class="row">
                @forelse ($attendances as $attendance)
                @if (($attendance->type) === 'Avançado')
                @can('Setor Tecnologia')
                <div class="carde col-sm-4">
                    <div id="training">
                        <a class="mt-2" id="" href="{{url($attendance->link)}}">
                            @if($attendance->photo)
                            <img class="img-fluid" src="{{asset("storage/attendance/$attendance->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title-index">{{$attendance->title}}</h4>
                                <p class="carde-text">{!! $attendance->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $attendance->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('attendance.edit' , ['attendance' => $attendance -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                        <form action="{{ route('attendance.destroy' , ['attendance' => $attendance -> id]) }}" method="post">
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
                @elseif(($attendance->type) === 'Comum')
                <div class="carde col-sm-4">
                    <div id="training">
                        <a class="mt-2" id="" href="{{url($attendance->link)}}">
                            @if($attendance->photo)
                            <img class="img-fluid" src="{{asset("storage/attendance/$attendance->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif  
                            <div class="block">
                                <h4 class="carde-title-index">{{$attendance->title}}</h4>
                                <p class="carde-text">{!! $attendance->description !!}</p>
                                <p class="carde-text-small"><small class="text-muted">Responsável: {{ $attendance->responsible }}</small></p>
                            </div>
                        </a>
                    </div>
                    <div class="d-flex justify-content-end mb-2">
                        @can('Editar Setor Tecnologia')
                            <a class=" btn mx-2" id="btn-default" href="{{ route('attendance.edit' , ['attendance' => $attendance -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                        @endcan
                        @can('Excluir Setor Tecnologia')
                        <form action="{{ route('attendance.destroy' , ['attendance' => $attendance -> id]) }}" method="post">
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
            {{ $attendances->links() }}
         </div>
    </div>
@endsection








