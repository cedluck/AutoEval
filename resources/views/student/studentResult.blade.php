@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Voici l'auto-évaluation de : <strong>{{ \Illuminate\Support\Facades\Auth::user()->name }}</strong></h4>
        <table class="table">
            <tr>
                <th>Question</th>
                <th>Résultat</th>
            </tr>
            @foreach($questions as $question)
                <tr>
                    <td>{{ $question->question }}</td>
                    <td>{{ $res[$question->id] }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection