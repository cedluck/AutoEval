@extends('layouts.teacher')

@section('content')
    <br>
    <div class="col-sm-offset-4 col-sm-4">
        <div class="panel panel-info">
            <div class="panel-heading">Importer un questionnaire</div>
            <div class="panel-body">
                @if(session()->has('error'))
                    <div class="alert alert-danger">{!! session('error') !!}</div>
                @endif
                {!! Form::open(['url' => route('csv'), 'files' => true]) !!}
                <div class="form-group {!! $errors->has('csv') ? 'has-error' : '' !!}">
                    <label for="list">Importer le questionnaire (format csv, séparateur ";")</label>
                    {!! Form::file('csv', ['class' => 'form-control']) !!}
                    {!! $errors->first('csv', '<small class="help-block">:message</small>') !!}
                </div>
                {!! Form::submit('Envoyer !', ['class' => 'btn btn-info pull-right']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection