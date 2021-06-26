@extends('layouts.app')
@section('title', 'Ramais')
@section('content')
        <div class="d-flex justify-content-center">
            <div class="col-sm-11">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        @can('Cadastrar Ramal')
                          <a href="{{route('branch.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo Ramal</a>
                        @endcan
                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <div class="contaniner-sm" id="administrative">
                            <div class="row">
                                <div class="administrative-title col-sm-12 my-3">
                                    <h1>Ramais</h1>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <form class="form form-inline d-flex justify-content-center" action="{{ route('branch.search') }}" method="POST">
                                @csrf
                                <div>
                                    <input class="form-control" type="text" name="search" id="filter" placeholder="Pesquisar">
                                    <button class="form-control" type="submit"><i class="fa fa-search"></i></button>
                                </div>
                          </form>
                          <div class="responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Setor</th>
                                    <th scope="col">Ramal</th>
                                    <th scope="col">Funciona de:</th>
                                    <th scope="col">Colaborador</th>
                                    @can('Informatica')
                                    <th scope="col">Ações</th>
                                    @else
                                    <th scope="col"></th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($branchs as $branch)
                                        <tr>
                                            <td>{{ $branch -> sector }}</td>
                                            <td>{{ $branch -> branch }}</td>
                                            <td> {{ date("H:i", strtotime($branch -> operation_initial)) }} as {{ date("H:i", strtotime($branch -> operation_end)) }}</td>
                                            <td>{{ $branch -> collaborator }}</td>
                                            <td class="d-flex justify-content-center">
                                                @can('Editar Ramal')
                                                        <a class="btn mx-2" id="btn-default-branch" href="{{ route('branch.edit' , ['branch' => $branch -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                @endcan
                                                @can('Excluir Ramal')
                                                    <form action="{{ route('branch.destroy' , ['branch' => $branch -> id]) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn" id="btn-default-branch">
                                                            <a><i class="fa fa-trash" aria-hidden="true"></i></a> Excluir
                                                        </button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                        </fieldset>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-2">
            @if (isset($filters))
            {{ $branchs->appends($filters)->links() }}
            @else
            {{ $branchs->links() }}
            @endif
        </div>
@endsection
