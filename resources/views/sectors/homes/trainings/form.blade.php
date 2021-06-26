@extends('layouts.app')
@section('title', 'Treinamentos')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-5">
        <div>
            <a class="btn mt-5" href="{{ route('training.index') }}" id="btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
        </div>
    <form method="POST" action="{{$action}}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @isset($training)
            @method('PUT')
        @endisset
        <div class="form-group">
            <label for="name">Título</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Insira um titulo" value="{{ old('name', $training->name ?? '') }}"  >
            @error('name')
                <span class="error"><small>{{ $message }}</small></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="url">Link</label>
            <input class="form-control" type="text" name="url" id="url" placeholder="Insira o link"  value="{{ old('url', $training->url ?? '') }}">
            @error('url')
                <span class="error"><small>{{ $message }}</small></span>
             @enderror
        </div>
        <div class="form-group">
            <label for="photo">Imagem</label><br>
            <input type="file" name="photo" id="photo" value="{{ old('photo', $training->photo ?? '') }}"><br>
            @error('photo')
                 <span class="error"><small>{{ $message }}</small></span>
             @enderror
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn" id="btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
        </div>
    </form>
    </div>
</div>
@endsection
