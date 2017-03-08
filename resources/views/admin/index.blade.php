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
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="table-text"><div>{{ $user->name }}</div></td>
                                    <td><input type="radio" name="optionsRadios{{ $user->id }}" value="option1" {{ $user->hasRole('Admin') ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="optionsRadios{{ $user->id }}" value="option2" {{ $user->hasRole('Salesman') ? 'checked' : '' }}></td>
                                    <td><input type="radio" name="optionsRadios{{ $user->id }}" value="option3" {{ $user->hasRole('User') ? 'checked' : '' }}></td>
                                    <!-- User Delete Button 
                                    <td>
                                        <form action="{{ url('admin/'.$user->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-btn fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                    -->
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
