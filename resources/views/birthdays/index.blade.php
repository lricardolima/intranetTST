@extends('layouts.app')
@section('title', 'Aniversariantes')
@section('content')
        <div class="d-flex justify-content-center ">
            <div class="col-sm-11">
                        @if (session('message'))
                            <div class="alert alert-success" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        @can('Cadastrar Aniversario')
                          <a href="{{route('birthday.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Novo Registro</a>
                        @endcan
                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <div class="contaniner-sm" id="birthday">
                            <div class="row">
                                <div class="compliment-title col-sm-12 my-5">
                                    <h1>Aniversariantes do Mês</h1>
                                    <hr>
                                </div>
                            </div>
                        </div>
                        <fieldset>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Aniversário</th>
                                        <th scope="col">Setor</th>
                                        @can('Cadastrar Aniversario')
                                        <th scope="col">CPF</th>
                                        <th scope="col">Ações</th>
                                        @else
                                        <th scope="col"></th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($birthdays as $birthday)
                                            <tr>
                                                @if($birthday->photo)
                                                <td><img class="img-top" src="{{asset("storage/birthday/$birthday->photo")}}" alt=""></td>
                                                @else
                                                <td><i class="fa fa-user fa-4x"></i></td>
                                                @endif
                                                <td>{{ $birthday -> name }}</td>
                                                <td>{{date('d/m',strtotime($birthday->date))}}</td>
                                                <td>{{$birthday->sector}}</td>
                                                @can('Cadastrar Aniversario')
                                                <td>{{$birthday->cpf}}</td>
                                                @endcan
                                                <td class="d-flex justify-content-center">
                                                    @can('Editar Aniversario')
                                                            <a class="btn mx-2" id="btn-default-branch" href="{{ route('birthday.edit' , ['birthday' => $birthday -> id]) }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                                    @endcan
                                                    @can('Excluir Aniversario')
                                                        <form action="{{ route('birthday.destroy' , ['birthday' => $birthday -> id]) }}" method="post">
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
            {{ $birthdays->links() }}
         </div>
@endsection
