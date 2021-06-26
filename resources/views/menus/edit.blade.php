@extends('layouts.app')
@section('title', 'Refeição')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-5">
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
        <div class="mb-4">
            <a class="btn mt-5" id="btn-default" href="{{ route('menu.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
        </div>
        <form action="{{ route('menu.update', ['menu' => $menu -> id]) }}" method="post" class="mt-4" autocomplete="off">
            @csrf
            @method('PUT')
        <div class="form-group">
            <label for="meal" class="textMenu">Refeição</label>
            <input class="form-control" type="text" name="meal" id="meal" placeholder="Insira uma Refeição" value="{{ old('meal') ?? $menu -> meal }}" required >
        </div>
        <div class="form-group">
            <label for="notices" class="textMenu">Descrição</label>
            <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Insira as informações da refeição">{{ old('description') ?? $menu -> description }}</textarea>
        </div>
        <div class="form-group">
            <label for="date" class="textMenu">Data da Refeição</label>
            <input class="form-control" type="date" name="date" id="responsible"value="{{ old('date') ?? $menu -> date }}" required >
        </div>
        <div class="d-flex justify-content-end mt-2">
            <button type="submit" class="btn" id="btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> Alterar</button>
        </div>
    </form>
    </div>
</div>
@endsection
