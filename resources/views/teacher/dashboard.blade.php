@extends('layouts.teacher')

@section('content')
    @if ($errors->has('list'))
        <div class="alert alert-danger">
            <strong>{!!  $errors->first('list', "L'élève n'a pas encore répondu au questions") !!}</strong>
        </div>
    @endif
    <div class="container">
        <div class="row">
            <a href="exportData" class="btn btn-primary pull-right">Exporter les résultats</a>
        </div>  
        <div class="row">
            <div class="col-sm-offset-3 col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Liste des élèves <span class="pull-right">{{$students->count()}} élèves</span></h3>
                    </div>
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{!! $student->id !!}</td>
                                <td class="text-primary"><strong>{!! $student->IsNameStudent() !!}</strong></td>
                                <td><a href="Tableau-de-bord/{!! $student->id !!}/showResults" class="btn btn-success btn-block">Voir</a></td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'route' => ['suppression-eleves', $student->id]]) !!}
                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-block', 'onclick' => 'return confirm(\'Vraiment supprimer cet utilisateur ?\')']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection