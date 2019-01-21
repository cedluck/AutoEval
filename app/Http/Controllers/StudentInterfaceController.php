<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Results;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentInterfaceController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:student');
    }

    public function index()
    {
        $hasValidated = Classes::where('id', Auth('student')->id())->value('hasValidated');

        if($hasValidated != 1)
        {
            $teacherId = auth('student')->user()->teacher_id;
            $questions = User::find($teacherId)->questions;
            return view('student.student', compact('questions'));
        }
        else
        {
            return view('.student.hasValidated');
        }
    }

    public function postForm(Request $request)
    {

            // Extrait les questions correspondant au questionnaire soumis
            $questions = User::find(Auth('student')->user()->teacher_id)->questions;

            // Règles de validation
            $validated = $request->validate([
                "list" => 'required|array|min:' . count($questions)
            ]);

            // Récupère les réponses
            $res = $request->input('list');

            // Efface les réponses déjà dans la BD pour le même élève
            Results::where('student_id', Auth('student')->user()->id)->delete();

            // insère les réponses dans la BD
            if ($validated) {
                foreach ($questions as $question) {
                    $results = new Results();
                    $results->question_id = $question->id;
                    $results->result = $res[$question->id];
                    $results->student_id = Auth::user()->id;
                    $results->save();
                }

                Classes::where('id', Auth('student')->id())->update(['hasValidated' => 1]);


                return view('student.studentResult', compact('res', 'questions'));

            } else {

                return redirect('student.student');

            }

    }
}