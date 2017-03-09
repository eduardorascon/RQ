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
