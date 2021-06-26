@extends('layouts.app')
@section('title', 'Refeição')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-5">
            <div>
                <a class="btn mt-5" href="{{ route('menu.index') }}" id="btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
            </div>
        <div class="card-body">
            @if (session('message'))
                <div class="alert alert-success mt-2" role="alert">
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
        <form method="POST" action="{{route('menu.store')}}" autocomplete="off">
            @csrf
            <div class="form-group">
                <label for="meal">Refeição</label>
                <input class="form-control" type="text" name="meal" id="meal" placeholder="Insira uma Refeição" value="{{ old('meal') }}" required >
            </div>
            <div class="form-group">
                <label for="notices">Descrição</label>
                <textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="Insira as informações da refeição" value="{{ old('description') }}"></textarea>
            </div>
            <div class="form-group">
                <label for="date">Data da Refeição</label>
                <input class="form-control" type="date" name="date" id="responsible"value="{{ old('date') }}" required >
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn" id="btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
            </div>
        </form>
   </div>
</div>
@endsection

