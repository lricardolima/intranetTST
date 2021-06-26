@extends('layouts.app')
    @section('title', 'Noticias')
        @section('content')
        <div class="d-flex justify-content-center">
            <div class="col-sm-11">
                <div class="container-sm" id="notice-body-show">
                    <div class="row">
                        <div class="carde col-sm-12">
                            <div id="notice-show">
                                    @if($notice->photo)
                                    <img class="img-fluid" src="{{asset("storage/notice/$notice->photo")}}" alt="">
                                    @else
                                    <img class="img-fluid" src="{{url("img/sectors/noimage.png")}}" alt="">
                                    @endif
                                    <div class="block">
                                        <h4 class="carde-show-title">{{$notice->title}}</h4>
                                        <p class="carde-show-text">{!!$notice->notice!!}</p>
                                        <p class="carde-show-text-small"><small class="text-muted">Responsável: {{$notice->responsible}}</small></p>
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
