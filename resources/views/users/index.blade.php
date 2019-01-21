@extends('layouts.app')

@section('content')
    <br>
    <div class="col-sm-offset-3 col-sm-5">
        @if(session()->has('ok'))
            <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
        @endif
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des utilisateurs</h3>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Niveau</th>
                    <th></th>
                    <th></th>

                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{!! $user->id !!}</td>
                        <td class="text-primary"><strong>{!! $user->name !!}</strong></td>
                        @if($user->admin == 1)
                            <td>Administrateur</td>
                        @else
                            <td>Enseignant</td>
                        @endif
                        <td>{!! link_to_route('users.show', 'Voir', [$user->id], ['class' => 'btn btn-success btn-block']) !!}</td>
                        <td>{!! link_to_route('users.edit', 'Modifier', [$user->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}
                            {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! link_to_route('users.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-info pull-right']) !!}
        {!! $links !!}
    </div>
@endsection