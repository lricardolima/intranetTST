@extends('layouts.app')
@section('title', 'Departamento Pessoal')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-5">
        <div>
            <a class="btn mt-5" href="{{ route('personalDepartment.index') }}" id="btn-default"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
        </div>
    <form method="POST" action="{{$action}}" autocomplete="off" enctype="multipart/form-data">
        @csrf
        @isset($personalDepartment)
            @method('PUT')
        @endisset
        <div class="form-group">
            <label for="title">Título</label>
            <input class="form-control" type="text" name="title" id="title" placeholder="Insira um titulo" value="{{ old('title', $personalDepartment->title ?? '') }}"  >
            @error('title')
                <span class="error"><small>{{ $message }}</small></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="type">Tipo de Usuário</label>
               <div class="">
                   <select class="custom-select my-1 mr-sm-3" id="type" name="type">
                       <option selected disabled>Escolher...</option>
                       <option value="Avançado"  {{ old('Avançado', $personalDepartment->type ?? '')==='Avançado' ? 'selected' : '' }}>Avançado</option>
                       <option value="Comum"  {{ old('Comum', $personalDepartment->type  ?? '')=== 'Comum' ? 'selected' : '' }}>Comum</option>
                   </select>
                   @error('type')
                   <span class="error"><small>{{ $message }}</small></span>
                @enderror
               </div>
        </div>
        <div class="form-group">
            <label for="description">Descrição</label>
            <textarea class="form-control" name="description" id="editor" cols="30" rows="10" placeholder="Insira uma breve descrição"  >{{ $personalDepartment->description ?? '' }}</textarea>
            @error('description')
                 <span class="error"><small>{{ $message }}</small></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="link">Link</label>
            <input class="form-control" type="text" name="link" id="link" placeholder="Insira o link"  value="{{ old('link', $personalDepartment->link ?? '') }}">
            @error('link')
                <span class="error"><small>{{ $message }}</small></span>
             @enderror
        </div>
        <div class="form-group">
            <label for="administrative_id">Setor pertencente</label>
            <div class="">
                <select class="custom-select my-1 mr-sm-3" id="administrative_id" name="administrative_id">
                    <option disabled selected>Selecione o setor</option>
                    @foreach ($administratives as $administrative)
                        <option value="{{ $administrative -> id }}"
                            {{ old('administrative_id', $personalDepartment->administrative->id ?? '') == $administrative->id ? 'selected' : '' }}>{{ $administrative -> name }}</option>
                    @endforeach
                </select>
                @error('administrative_id')
                <span class="error"><small>{{ $message }}</small></span>
             @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="responsible">Responsável</label>
            <input class="form-control" type="text" name="responsible" id="responsible" placeholder="Insira o Responsável" value="{{ old('responsible', $personalDepartment->responsible ?? '') }}"  >
            @error('respondible')
                <span class="error"><small>{{ $message }}</small></span>
            @enderror
        </div>
        <div class="form-group">
            <label for="photo">Imagem</label><br>
            <input type="file" name="photo" id="photo" value="{{ old('photo', $personalDepartment->photo ?? '') }}"><br>
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
