@extends('layouts.app')
    @section('title', 'Elogios')
        @section('content')
        <div class="d-flex justify-content-center">
            <div class="col-sm-11">
                <div class="container-sm" id="compliment-body-show">
                    <div class="row">
                        <div class="carde col-sm-12">
                            <div id="compliment-show">
                                @if($compliment->photo)
                                <img class="img-fluid" src="{{asset("storage/compliments/$compliment->photo")}}" alt="">
                                @else
                                <img class="img-fluid" src="{{url("img/sectors/noimage.png")}}" alt="">
                                @endif
                                <div class="block">
                                    <h4 class="carde-show-title">{{$compliment->title}}</h4>
                                    <p class="carde-show-text">{!!$compliment->compliments!!}</p>
                                    <p class="carde-show-text-small"><small class="text-muted">Responsável: {{$compliment->responsible}}</small></p>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-end col-sm-12 btn-end">
                            <a href="{{url('/')}}" class="btn mt-3" id="button-default"> Voltar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
