@extends('layouts.app')
@section('title', 'Elogios')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-5">
        <div>
            <a class="btn mt-5" href="{{ route('compliment.index') }}" id="btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
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
    <form method="POST" action="{{route('compliment.store')}}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Título do Elogio</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="Insira um titulo" value="{{ old('title') }}" autocomplete="off"  required >
        </div>
        <div class="form-group">
            <label for="compliments">Elogio</label>
            <textarea class="form-control" name="compliments" id="editor" cols="30" rows="10" placeholder="Insira o elogio" value="{{ old('compliments') }}" ></textarea>
        </div>
        <div class="form-group">
            <label for="responsavel">Responsável</label>
            <input class="form-control" type="text" name="responsible" id="responsible" placeholder="Insira o autor do elogio" value="{{ old('responsible') }}" autocomplete="off" required >
        </div>
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
