@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading text-center autoeval">AutoEval
                    <div class="sous-titre">"s'toi l'évaluateur !"</div>
                     </div>
                    <div class="panel-body">
                        <div class="col-sm-12 text-center">
                            Connectez-vous en tant que :
                        </div>

                        <div class="col-sm-6">
                            <a href="login" class="btn btn-primary btn-block">Professeur</a>
                        </div>
                        <br>
                        <div class="col-sm-6">
                            <a href="{{ route('student.login') }}" class="btn btn-primary btn-block">Elève</a>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection