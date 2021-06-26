@extends('layouts.app')
@section('title', 'Setores')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        <div class="contaniner-sm" id="administrative">
            <div class="row">
                <div class="administrative-title col-sm-12 my-5">
                    <h1>Administrativos</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="administrative">
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
                                <h4 class="carde-title"></h4>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
            <h4 class="card-title">Não existe Informações cadastrados</h4>
            @endforelse
            <div class="row d-flex justify-content-end col-sm-12 btn-end">
                <a href="{{route('administrative.index')}}" class="btn mt-3" id="button-default">Todos setores administrativos</a>
            </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        <div class="contaniner-sm" id="assistance">
            <div class="row">
                <div class="assistance-title col-sm-12 my-5">
                    <h1>Assistencial</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="assistance-body">
            <div class="row">
                @forelse ($assistances as $assistance)
                <div class="carde col-sm-3">
                    <div id="assistance">
                        <a class="mt-2" id="" href="{{url($assistance->url)}}">
                            @if($assistance->image)
                            <img class="img-fluid" src="{{asset("storage/assistance/$assistance->image")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="carde-title"></h4>
                            </div>
                        </a>
                    </div>
                </div>
            @empty
            <h4 class="card-title">Não existe Informações cadastrados</h4>
            @endforelse
            <div class="row d-flex justify-content-end col-sm-12 btn-end">
                <a href="{{route('assistance.index')}}" class="btn mt-3" id="button-default">Todos setores assistenciais</a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
