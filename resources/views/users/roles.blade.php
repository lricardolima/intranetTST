@extends('layouts.app')
@section('title', 'Perfis')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <h2 class="text-center">Perfis</h2>
                    <div class="card-body">
                        <a class="btn" id="btn-default" href="{{ route('user.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Voltar para a listagem</a>
                        @if($errors)
                            @foreach($errors->all() as $error)
                                <div class="alert alert-danger mt-4" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <h2 class="mt-4">Perfil de: {{ $user -> name }}</h2>
                        <form action="{{ route('user.rolesSync', ['user' => $user -> id]) }}" method="post" class="mt-4" autocomplete="off">
                            @csrf
                            @method('PUT')
                            @foreach($roles as $role)
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="{{ $role -> id }}" name="{{ $role -> id }}" {{ ($role -> can == '1' ? 'checked' : '')}}>
                                    <label class="custom-control-label" for="{{ $role -> id }}">{{ $role -> name }}</label>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-block mt-4" id="btn-default">Sincronizar {{ $user -> name }}</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
