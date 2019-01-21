@extends('layouts.teacher')

@section('content')
<div class="col-sm-offset-4 col-sm-4">
    <div class="panel panel-info">
        <div class="panel-heading">Voir la list des élèves</div>
        <div class="panel-body">
            @if(session()->has('error'))
                <div class="alert alert-danger">{!! session('error') !!}</div>
            @endif
            {!! Form::open(['url' => 'Professeur/affichage-eleves', 'files' => true]) !!}
            <div class="form-group {!! $errors->has('csv') ? 'has-error' : '' !!}">
                <label for="list">Pour voir les élèves importez la liste des élèves que vous avez créé (format csv, séparateur ";")</label>
                {!! Form::file('csv', ['class' => 'form-control', 'id' => 'list']) !!}
                {!! $errors->first('csv', '<small class="help-block">:message</small>') !!}
            </div>
            {!! Form::submit('Voir la classe', ['class' => 'btn btn-info pull-right']) !!}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection