@extends('layouts.teacher')

@section('content')
<div class="col-sm-offset-4 col-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading">Création d'une classe</div>
        <div class="panel-body">
            @if(session()->has('error'))
                <div class="alert alert-danger">{!! session('error') !!}</div>
            @endif
            {!! Form::open(['url' => 'Professeur/storeClassroom', 'files' => true]) !!}
            <div class="form-group {!! $errors->has('csv') ? 'has-error' : '' !!}">
                <label for="list">Importer la liste des élèves (format csv, séparateur ";")</label>
                {!! Form::file('csv', ['class' => 'form-control', 'id' => 'list']) !!}
                {!! $errors->first('csv', '<small class="help-block">:message</small>') !!}
            </div>
            {!! Form::submit('Importer les noms des élèves', ['class' => 'btn btn-info pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection