@extends('layouts.app')
@section('title', 'Carrousel')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-5">
        <div>
            <a class="btn mt-5" href="{{ route('carousel.index') }}" id="btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
        </div>
    <div class="card-body">
        @if (session('message'))
            <div class="alert alert-success 2" role="alert">
                {{ session('message') }}
            </div>
        @endif
        @if($errors)
            @foreach($errors->all() as $error)
                <div class="alert alert-danger mt-2" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
    </div>
    <form method="POST" action="{{route('carousel.store')}}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="photo">Imagem</label><br>
            <input type="file" name="photo" id="photo" value="{{ old('photo') }}"><br>
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn" id="btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
        </div>
    </form>
    </div>
</div>
@endsection
