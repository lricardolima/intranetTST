@extends('layouts.app')
    @section('title', 'Elogios')
        @section('content')
            <div class="d-flex justify-content-center">
                <div class="col-sm-10">
                    @can('Cadastrar Elogio')
                        <a href="{{route('compliment.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo Elogio</a>
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
                    <div class="contaniner-sm" id="compliment">
                        <div class="row">
                            <div class="compliment-title col-sm-12 my-5">
                                <h1>Elogios</h1>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="container-sm" id="compliment-body">
                        <div class="row">
                            @forelse ($compliments as $compliment)
                           <div class="carde col-sm-4">
                            <div id="compliment">
                                <a class="mt-2" id="" href="{{route('compliment.show', $compliment->id)}}">
                                    @if($compliment->photo)
                                    <img class="img-fluid" src="{{asset("storage/compliments/$compliment->photo")}}" alt="">
                                    @else
                                    <img class="img-fluid" src="{{url("img/sectors/noimage.png")}}" alt="">
                                    @endif
                                    <div class="block">
                                        <h4 class="title">{{$compliment->title}}</h4>
                                        <p class="text">{!! $compliment->compliments !!}</p>
                                    </div>
                                </a>
                                <div class="d-flex justify-content-end mb-2">
                                    @can('Editar Elogio')
                                        <a class=" btn mt-2 mr-2" id="btn-default" href="{{ route('compliment.edit' , ['compliment' => $compliment -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    @endcan
                               </div>
                            </div>
                           </div>
                        @empty
                        <h4 class="card-title">Não foram publicados novos elogios </h4>
                        @endforelse
                        </div>
                    </div>
                 </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
               {{ $compliments->links() }}
            </div>
        @endsection
