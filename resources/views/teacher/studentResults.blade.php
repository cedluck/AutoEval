@extends('layouts.app')

@section('content')

    <div class="container">
        <h4>Résultat de l'élève : <strong>{{ $studentName }}</strong></h4>
        <table class="table">
            <tr>
                <th>Question</th>
                <th>Résultat</th>
            </tr>
            @foreach($results as $key => $result)
                <tr>
                    <td>{{ $questions[$key]->question }}</td>
                    <td>{{ $result->result }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="col-sm-12">
        <a href="javascript:history.back()" class="btn btn-primary">
            Retour
        </a>
    </div>
@endsection