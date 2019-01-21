<?php
namespace App\Http\Controllers;

use App\Questions;
use App\Results;
use App\Http\Requests\CheckCsvRequest;
use App\Student;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    /* Affichage du tableau de bord pour les professeurs */
    public function index() {
        $teacher_id = Auth::id();
        $students = Student::where('teacher_id', $teacher_id)->orderby('id', 'asc')->get();
        
        return view('teacher.dashboard', compact('students'));
    }

    public function convert( $str ) {
        return iconv( "UTF-8", "Windows-1252", $str );
    }

    /* Création d'une classe */
    public function create() {
        return view('teacher.createClassroom');
    }


    /* Enregistrement des élèves via fichier csv et exportation des données id/nom  des élèves */
    public function store(CheckCsvRequest $request) {
        $file = fopen($request->file('csv'), "r");
        $list = [];
        
        $id = Auth::id();

        //Enregistrement dans la BDD des ids des élèves
        while (($getData = fgetcsv($file, null, ";")) !== FALSE){
            $password = str_random(6);

            $student = new Student;
            $student->name = str_random(15);
            $student->password = bcrypt($password);
            $student->teacher_id = $id;
            $student->save();

            $student->name = $student->id;
            $student->save();

            array_push($list, [$student->name, $getData[0], $password]);
        }
			
        fclose($file);	
          
        //Création du fichier à exporter
        $new_file = fopen("liste_eleves.csv", "w");
        foreach($list as $line){
            fputcsv($new_file, $line, ";");
        }
        fclose($new_file);
          
        return response()->download("liste_eleves.csv")->deleteFileAfterSend(true);
    }

    //Vue sur le formulaire d'importation des noms des élèves
    public function importNameForm(){
        return view('teacher.affichageEleves');
    }
    
    //Importation des noms des élèves + stockage dans les variables de sessions
    public function ImportName(CheckCsvRequest $request) {
        $file = fopen($request->file('csv'), 'r');
        $list = [];

        while(($getData = fgetcsv($file, null, ';')) !== False)
        {
            $list[$getData[0]] = $getData[1];
        }
        fclose($file);

        session(['students' => $list]);

        return redirect()->route('dashboardTeacher');
    }

    public function showResults ($id)
    {
        $studentName = session('students.'.$id);
//        dd($studentName);
        $results = Results::where('student_id', $id)->get();
        $questions = Questions::where('user_id', Auth::user()->id)->get();

        if($results->isNotEmpty())
        {
            return view('teacher.studentResults', compact('results', 'id', 'questions', 'studentName'));
        }
        else
        {
            return redirect()->route('dashboardTeacher');
        }

    }

    public function exportData() {
        $teacher_id = Auth::id();
        $data = Student::where('teacher_id', $teacher_id)->orderBy('id','asc')->with('results.question')->get();

        $row = [""];
        foreach($data->first()->results as $result) {
             array_push($row, $this->convert($result->question->rubrique) .': '. $this->convert($result->question->question));
        }
        $csv = [$row];

        foreach($data as $student){
            $row = [$this->convert($student->IsNameStudent())];

            foreach($student->results as $result) {
                array_push($row, $result->result);
            }
            array_push($csv, $row);           
        }

        $new_file = fopen("resultat_questionnaire.csv", "w");
        foreach($csv as $line){
            fputcsv($new_file, $line, ";");
        }
        fclose($new_file);
          
        return response()->download("resultat_questionnaire.csv")->deleteFileAfterSend(true);
        
    }

    public function deleteStudent($id) {
        Student::find($id)->delete();
        
        return back();
    }
}
