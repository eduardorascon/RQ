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

                        <!-- User Pass -->
                        <div class="form-group">
                            <label for="user-password" class="col-md-3 control-label">Password</label>

                            <div class="col-md-6">
                                <input type="password" name="password" id="user-password" class="form-control"  required>
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
                                <td>{{ $user->name }}</td>
                                <td colspan="4">
                                    <form action="{{ route('assign_role') }}" method="POST">
                                        <input type="radio" name="optionsRadios" value="Admin" {{ $user->hasRole('Admin') ? 'checked' : '' }} />
                                        <input type="radio" name="optionsRadios" value="Salesman" {{ $user->hasRole('Salesman') ? 'checked' : '' }} />
                                        <input type="radio" name="optionsRadios" value="User" {{ $user->hasRole('User') ? 'checked' : '' }} />
                                        <input type="hidden" name="email" value="{{ $user->email }}" />
                                        {{ csrf_field() }}
                                        <!-- User Role Button -->
                                        <button type="submit" class="btn"><i class="fa fa-btn fa-trash"></i>Cambiar permiso</button>
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
