@extends('layouts.app')
    @section('title', 'Refeição')
        @section('content')
            <div class="d-flex justify-content-center">
                <div class="col-sm-11">
                    @can('Cadastrar Refeicao')
                        <a href="{{route('menu.create')}}" class="btn mt-5 mr-2" id="btn-default"><i class="fa fa-plus" aria-hidden="true"></i> Nova Refeição</a>
                    @endcan
                    <div class="card-body">
                        @if (session('message'))
                            <div class="alert alert-success mt-2" role="alert">
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
                       <fieldset>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th colspan="8" class=""><h3>Cardápio</h3></th>
                                </tr>
                            </thead>
                        @foreach($menus as $menu)
                            <tbody>
                                <tr>
                                    <td>{{date('d/m/Y',strtotime($menu->date))}}</td>
                                    <td>{{$menu->meal}}</td>
                                    <td>{!!$menu->description!!}</td>
                                    <td class="d-flex justify-content-center">
                                        @can('Editar Refeicao')
                                            <a class="btn mx-2" href="{{ route('menu.edit' , ['menu' => $menu -> id]) }}" id="btn-menu"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                                        @endcan
                                        @can('Excluir Refeicao')
                                        <form action="{{ route('menu.destroy' , ['menu' => $menu -> id]) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn" id="btn-menu">
                                                <a><i class="fa fa-trash" aria-hidden="true"></i></a> Excluir
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            </tbody>
                        @endforeach
                        </table>
                       </fieldset>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-2">
               {{ $menus->links() }}
            </div>
        @endsection
