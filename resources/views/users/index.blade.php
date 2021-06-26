@extends('layouts.app')
@section('title', 'Gestão de Usuários')
@section('content')

<div class="d-flex justify-content-center">
    <div class="col-sm-11">
                @if (session('message'))
                    <div class="alert alert-success" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @can('Cadastrar Setor Tecnologia')
                  <a href="{{route('user.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo Usuário</a>
                @endcan
                <div class="d-flex justify-content-end">
                    @can('Cadastrar Setor Tecnologia')
                    <a href="{{route('role.index')}}" class="btn" id="btn-default-secund"><i class="fa fa-user-o" aria-hidden="true"></i> </a>
                    @endcan
                </div>
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
                            <h1>Gestão de Usuários</h1>
                            <hr>
                        </div>
                    </div>
                </div>
                <fieldset>
                    <form class="form form-inline d-flex justify-content-center" action="{{ route('user.search') }}" method="POST">
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
                            <th>Usuário</th>
                            <th>E-mail</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user -> name }}</td>
                                    <td>{{ $user -> email }}</td>
                                    <td class="d-flex justify-content-center">
                                        @can('Editar Setor Tecnologia')
                                                <a class="btn mx-2" id="btn-default" href="{{ route('user.edit' , ['user' => $user -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                <a class="btn" id="btn-default" href="{{ route('user.roles' , ['user' => $user -> id]) }}"><i class="fa fa-user-o" aria-hidden="true"></i> Perfis</a>
                                        @endcan
                                        @can('Excluir Setor Tecnologia')
                                            <form action="{{ route('user.destroy' , ['user' => $user -> id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button class="btn" id="btn-default">
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
    {{ $users->appends($filters)->links() }}
    @else
    {{ $users->links() }}
    @endif
</div>

@endsection


