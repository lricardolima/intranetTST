@extends('layouts.app')
@section('title', 'Ramais')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div>
                    <a class="btn mt-5" id="btn-default" href="{{ route('branch.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
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
                        <form action="{{ route('branch.update', ['branch' => $branch->id]) }}" method="post" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="email">Setor</label>
                                <input type="text" class="form-control" id="sector" placeholder="Insira seu Setor" name="sector" value="{{ old('sector') ?? $branch -> sector }}">
                            </div>
                            <div class="form-group">
                                <label for="branch">Ramal</label>
                                <input type="text" class="form-control" id="branch" placeholder="Insira o Ramal" name="branch" value="{{ old('branch')?? $branch -> branch }}">
                            </div>
                            <div class="form-group">
                                <label for="operation_initial">Funciona de:</label>
                                <input type="time" class="form-control" id="operation_initial" placeholder="Insira seu Horário de Funcionamento" name="operation_initial" value="{{ old('operation_initial') ?? $branch -> operation_initial }}">
                            </div>
                            <div class="form-group">
                                <label for="operation_initial">As:</label>
                                <input type="time" class="form-control" id="operation_end" placeholder="Insira seu Horário de Funcionamento" name="operation_end"  value="{{ old('operation_end') ?? $branch -> operation_end }}">
                            </div>
                            <div class="form-group">
                                <label for="collaborator">Colaborador</label>
                                <textarea class="form-control" name="collaborator" id="collaborator" cols="30" rows="2"placeholder="Informe o nome dos Responsáveis" required>{{ old('collaborator') ?? $branch -> collaborator }}</textarea>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn" id="btn-default">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>Alterar</button>
                            </div>
                        </form>
            </div>
        </div>
    </div>
@endsection

