@extends('layouts.app')
    @section('title', 'Noticias')
        @section('content')
            <div class="d-flex justify-content-center">
                <div class="col-sm-10">
                    @can('Cadastrar Noticia')
                        <a href="{{route('notice.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Nova Notícia</a>
                    @endcan
                    <div class="card-body">
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
                    <div class="contaniner-sm" id="assistance">
                        <div class="row">
                            <div class="assistance-title col-sm-12 my-5">
                                <h1>Notícias</h1>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="container-sm" id="notice-body">
                        <div class="row">
                            @forelse ($notices as $notice)
                           <div class="carde col-sm-4">
                            <div id="notice">
                                <a class="mt-2" id="" href="{{route('notice.show', $notice->id)}}">
                                @if($notice->photo)
                                <img class="img-fluid" src="{{asset("storage/notice/$notice->photo")}}" alt="">
                                @else
                                <img class="img-fluid" src="{{url("img/sectors/noimage.png")}}" alt="">
                                @endif
                                <div class="block">
                                    <h4 class="title">{{$notice->title}}</h4>
                                    <p class="text">{!! $notice->notice !!}</p>
                                    <p class="small"><small class="text-muted">Responsável: {{ $notice->responsible }}</small></p>
                                </a>
                                    <div class="d-flex justify-content-end mb-2">
                                        @can('Editar Noticia')
                                            <a class=" btn mt-2 mr-2" id="btn-default" href="{{ route('notice.edit' , ['notice' => $notice -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                        @endcan
                                   </div>
                                </div>
                            </div>
                           </div>
                        @empty
                        <h4 class="card-title">Não foram publicadas nova notícias</h4>
                        @endforelse
                        </div>
                    </div>
                 </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
               {{ $notices->links() }}
            </div>
        @endsection
