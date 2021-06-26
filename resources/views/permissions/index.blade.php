@extends('layouts.app')
@section('title', 'Permissões')
@section('content')
<div class="d-flex justify-content-center">
    <div class="col-sm-11">
                @if (session('message'))
                    <div class="alert alert-success" permission="alert">
                        {{ session('message') }}
                    </div>
                @endif
                @can('Cadastrar Setor Tecnologia')
                  <a href="{{route('permission.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo Usuário</a>
                @endcan
                <div class="d-flex justify-content-end">
                    @can('Cadastrar Setor Tecnologia')
                    <a href="{{route('user.index')}}" class="btn" id="btn-default-secund"><i class="fa fa-user-o"></i> </a>
                    @endcan
                </div>
                @if($errors)
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger mt-4" permission="alert">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
                <div class="contaniner-sm" id="administrative">
                    <div class="row">
                        <div class="administrative-title col-sm-12 my-3">
                            <h1>Gerênciar Permissões</h1>
                            <hr>
                        </div>
                    </div>
                </div>
                <fieldset>
                  <form class="form form-inline d-flex justify-content-center" action="{{ route('permission.search') }}" method="POST">
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
                            <th>Permissão</th>
                            <th>Ações</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission -> name }}</td>
                                <td class="d-flex justify-content-center">
                                    <a class="mx-3 btn btn-sm btn-outline-success" href="{{ route('permission.edit' , ['permission' => $permission -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                    <form action="{{ route('permission.destroy' , ['permission' => $permission -> id]) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></a> Remover</button>
                                    </form>
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
    {{ $permissions->appends($filters)->links() }}
    @else
    {{ $permissions->links() }}
    @endif
</div>
@endsection
