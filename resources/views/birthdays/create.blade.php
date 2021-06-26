@extends('layouts.app')
@section('title', 'Aniversariantes')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-5">
            <div>
                <a class="btn mt-5" href="{{ route('birthday.index') }}" id="btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
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
        <form method="POST" action="{{route('birthday.store')}}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name">Nome</label>
                <input class="form-control" type="text" name="name" id="name" placeholder="Insira o nome do aniversáriante" value="{{ old('name') }}"  autocomplete="off" required >
            </div>
            <div class="form-group">
                <label for="date">Data de aniversário</label>
                <input class="form-control" type="date" name="date" id="date"value="{{ old('date') }}" data-mask="00/00/0000" maxlength="10" autocomplete="off" required >
            </div>
            <div class="form-group">
                <label for="sector">Setor</label>
                <input class="form-control" type="text" name="sector" id="sector"value="{{ old('sector') }}"  placeholder="Insira o nome do setor" autocomplete="off" required >
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input class="form-control cpf-mask" type="int" name="cpf" id="cpf"value="{{ old('cpf') }}" data-mask="000.000.000-00" maxlength="14" autocomplete="off" placeholder="000.000.000-00">
            </div>
            <div class="form-group">
                <label for="photo">Imagem</label><br>
                <input type="file" name="photo" id="photo" value="{{ old('photo') }}"><br>
            </div>
            <div class="d-flex justify-content-end col-sm-12 btn-end-create">
                <button type="submit" class="btn" id="btn-default"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
            </div>
        </form>
    </div>
@endsection


