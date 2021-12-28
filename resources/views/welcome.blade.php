@extends('layouts.app')
@section('title', 'Intranet - Gastroclinica')
@section('session')
<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  </ol>
  <div class="carousel-inner">
      @foreach ($carousels as $key => $carousel)
      <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
        <img src="{{asset("storage/carousel/$carousel->photo")}}" class="d-block w-100" alt="...">
      </div>
      @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
@endsection
@section('content')
<div id="voltarTopo">
    <a href="#" id="subir"><i class="fa fa-arrow-circle-up fa-3x"></i></a>
</div>
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        <div class="contaniner-sm" id="mv">
            <div class="row">
                <div class="mv-title col-sm-12 my-5">
                    <h1>Acesso ao MV</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="mv">
            <div class="row">
                <div class="carde col-sm-3">
                    <div id="mv">
                        <a class="mt-2" id="" href="{{url('http://1940prd.cloudmv.com.br/')}}">
                            <img class="img-fluid" src="{{asset("img/mv/mv.png")}}" alt="">
                            <div class="block">
                                <h4 class="title">Mv Produção</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="carde col-sm-3">
                    <div id="mv">
                        <a class="mt-2" id="" href="{{url('http://1940prd.cloudmv.com.br/mvpep')}}">
                            <img class="img-fluid" src="{{asset("img/mv/mv.png")}}" alt="">
                            <div class="block">
                                <h4 class="title-mv">Mv PEP</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="carde col-sm-3">
                    <div id="mv">
                        <a class="mt-2" id="" href="{{url('http://1940tst1.cloudmv.com.br:82/soul-mv/')}}">
                            <img class="img-fluid" src="{{asset("img/mv/mv.png")}}" alt="">
                            <div class="block">
                                <h4 class="title">Mv Teste</h4>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="carde col-sm-3">
                    <div id="mv">
                        <a class="mt-2" id="" href="{{url('Http://1940tst1.cloudmv.com.br:82/mvpep/')}}">
                            <img class="img-fluid" src="{{asset("img/mv/mv.png")}}" alt="">
                            <div class="block">
                                <h4 class="title">Mv PEP Teste</h4>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        <div class="contaniner-sm" id="notice">
            <div class="row">
                <div class="notice-title col-sm-12 my-5">
                    <h1>Notícias</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="notice">
            <div class="row">
                @forelse ($notices as $notice)
                <div class="carde col-sm-4">
                    <div id="notice">
                        <a class="mt-2" id="" href="{{route('notice.show', $notice->id)}}">
                            @if($notice->photo)
                            <img class="img-fluid" src="{{asset("storage/notice/$notice->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="title">{{$notice->title}}</h4>

                            </div>
                        </a>
                    </div>
                </div>
            @empty
            <h4 class="carde-subtitle">Não existe Informações cadastrados</h4>
            @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-end btn-end">
            <a href="{{route('notice.index')}}" class="btn mt-3" id="button-default">mais notícias</a>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        <div class="contaniner-sm" id="compliment">
            <div class="row">
                <div class="compliment-title col-sm-12 my-5">
                    <h1>Elogios</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="compliment">
            <div class="row">
                @forelse ($compliments as $compliment)
                <div class="carde col-sm-4">
                    <div id="compliment">
                        <a class="mt-2" id="" href="{{route('compliment.show', $compliment->id)}}">
                            @if($compliment->photo)
                            <img class="img-fluid" src="{{asset("storage/compliments/$compliment->photo")}}" alt="">
                            @else
                            <img class="img-fluid" src="{{asset("img/sectors/noimage.png")}}" alt="">
                            @endif
                            <div class="block">
                                <h4 class="title">{{$compliment->title}}</h4>

                            </div>
                        </a>
                    </div>
                </div>
            @empty
            <h4 class="carde-subtitle">Não existe Informações cadastrados</h4>
            @endforelse
            </div>
        </div>
        <div class="d-flex justify-content-end btn-end">
            <a href="{{route('compliment.index')}}" class="btn mt-3" id="button-default">mais elogios</a>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
        <div class="contaniner-sm" id="birthday">
            <div class="row">
                <div class="birthday-title col-sm-12 my-5">
                    <h1>Aniversariantes do dia</h1>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container-sm" id="birthday-body">
            <fieldset>
             <div class="row">
                 @forelse ($birthdays as $birthday)
                 <div class="carde col-sm-3">
                     <div id="birthday">
                         @if($birthday->photo)
                         <img class="img-fluid" src="{{asset("storage/birthday/$birthday->photo")}}" alt="">
                         @else
                         <i class="fa fa-user fa-5x" aria-hidden="true" style="margin-left: 25%;"></i>
                         @endif
                         <div class="block">
                             <h4 class="title">{{$birthday->name}}</h4>
                             <p class="text">{{ $birthday->sector }}</p>
                             <small class="text-muted">&#x1F382; Parabéns! &#x1F382;</small>
                         </div>
                     </div>
                 </div>
             @empty
             <h4 class="carde-subtitle-birthday">Nenhum aniversariante nesta data!</h4>
             @endforelse
             </div>
             <div class="d-flex justify-content-end btn-end">
                 <a href="{{route('birthday.index')}}" class="btn mt-3" id="button-default">mais aniversariantes</a>
             </div>
            </fieldset>
         </div>
    </div>
</div>
<div class="container-sm" id="quemsomos">
    <div class="row">
        <div class="quemsomos-title col-sm-12">
            <img class="img-fluid-quemsomos" src="{{asset('img/quemsomos.png')}}" alt="">
        </div>
    </div>
</div>
<br>
<div class="container-sm" id="conceitos">
    <div class="row">
        <div class="conceitos-title col-sm-12">
            <img class="img-fluid-conceitos" src="{{asset('img/missaovisaoevalores.png')}}" alt="">
        </div>
    </div>
</div>
<br>
@endsection
