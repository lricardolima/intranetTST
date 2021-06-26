@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex justify-content-center text-center">
                <div class="mt-5">
                    <div class="">
                        <img src="{{asset('img\bg.png')}}" width='350'>
                    </div>
                    <p class="textMenu mt-3">Bem vindo e bom trabalho!!</p>
                </div>
                <div class="">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    setTimeout(function(){
        window.location.href = "/intranet/public/"
    },2000);
</script>
@endsection
