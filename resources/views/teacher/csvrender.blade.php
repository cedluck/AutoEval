@extends('layouts.teacher')

@section('content')


    <div class="container">
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                @if(session()->has('ok'))
                    <div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
                @endif
                <div class="table">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th scope="col">Rubrique</th>
                            <th scope="col">Question</th>
                        </tr>
                        </thead>
                        @foreach($csv_data as $key => $data)
                        <tbody>
                            <tr>
                                <td scope="row">{{ $data->rubrique }}</td>
                                <td scope="row">{{ $data->question }}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-8">
                <a href="javascript:history.back()" class="btn btn-primary btn-block">
                    Retour
                </a>
            </div>
        </div>
    </div>




@endsection