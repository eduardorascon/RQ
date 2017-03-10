@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Panel de Control</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    Agregar un nuevo usuario
                </div>

                <div class="panel-body">
                    <!-- New User Form -->
                    <form action="{{ url('admin.create_new_user')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- User Name -->
                        <div class="form-group">
                            <label for="user-name" class="col-sm-3 control-label">Nombre</label>

                            <div class="col-sm-6">
                                <input type="text" name="name" id="user-name" class="form-control" value="{{ old('name') }}">
                            </div>
                        </div>

                        <!-- User Name -->
                        <div class="form-group">
                            <label for="user-email" class="col-sm-3 control-label">Correo electrónico</label>

                            <div class="col-sm-6">
                                <input type="text" name="email" id="user-email" class="form-control" value="{{ old('email') }}">
                            </div>
                        </div>

                        <!-- Add User Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Agregar usuario
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if (count($users) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    Listado de Usuarios
                </div>

                <div class="panel-body">
                    <table class="table table-striped user-table">
                        <thead>
                            <th>Nombre</th>
                            <th>Es administrador</th>
                            <th>Es vendedor</th>
                            <th>Es capturista</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="table-text"><div>{{ $user->name }}</div></td>
                                    <td><input type="radio" name="optionsRadios{{ $user->id }}" value="Admin" {{ $user->hasRole('Admin') ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="optionsRadios{{ $user->id }}" value="Salesman" {{ $user->hasRole('Salesman') ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="optionsRadios{{ $user->id }}" value="User" {{ $user->hasRole('User') ? 'checked' : '' }}></td>
                                    <!-- User Delete Button -->
                                    <td>
                                        <form action="{{ url('admin.assign') }}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="email" value="{{ $user->email }}">
                                            <button type="submit" class="btn">
                                                <i class="fa fa-btn fa-trash"></i>Actualizar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
