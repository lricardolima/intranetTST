@extends('layouts.app')
@section('title', 'Assistencial')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-5">
        <div>
            <a class="btn mt-5" href="{{ route('assistance.index') }}" id="btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
        </div>
    <form method="POST" action="{{$action}}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @isset($assistance)
            @method('PUT')
        @endisset
        <div class="form-group">
            <label for="name">Título</label>
            <input class="form-control" type="text" name="name" id="name" placeholder="Insira um titulo" value="{{ old('name', $assistance->name ?? '') }}"  >
            @error('name')
                <span class="error"><small>{{ $message }}</small></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="url">Link</label>
            <input class="form-control" type="text" name="url" id="url" placeholder="Insira o link"  value="{{ old('url', $assistance->url ?? '') }}">
            @error('url')
                <span class="error"><small>{{ $message }}</small></span>
             @enderror
        </div>
        <div class="form-group">
            <label for="image">Imagem</label><br>
            <input type="file" name="image" id="image" value="{{ old('image', $assistance->image ?? '') }}"><br>
            @error('image')
                 <span class="error"><small>{{ $message }}</small></span>
             @enderror
        </div>
        <div class="d-flex justify-content-end col-sm-12 btn-end-create">
            <button type="submit" class="btn" id="btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
        </div>
    </form>
    </div>
</div>
@endsection
