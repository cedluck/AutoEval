<?php
/**
 * Created by PhpStorm.
 * User: CED
 * Date: 10/06/2018
 * Time: 20:52
 */

namespace App\Models\CsvGestion;


use App\Classes;
use App\Http\Requests\CsvRequest;
use App\Questions;
use App\Results;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CsvGestion implements CsvGestionInterface
{
    /**
     * Use as model to store data in the $questions table using Eloquent
     *
     * @param CsvRequest $request
     * @return array|bool
     */


    public function convert( $str ) {
        return iconv( "Windows-1252", "UTF-8", $str );
    }

    public function save(CsvRequest $request)
    {
        // gets the extension
        $extension =  $request->file('csv')->getClientOriginalExtension();

        if ($extension == 'csv')// if extension is 'csv'
        {
            // Delete results in 'results" table for the given teacher
            $questions = Questions::where('user_id', Auth::user()->id)->get(['id']);

            foreach ($questions as $key => $question)
            {
                Results::where('question_id', $questions[$key]['id'])->delete();
            }

            //  Puts hasValidated to 0 given the teacher_id
            Classes::where('teacher_id', Auth::user()->id)->update(['hasValidated' => 0]);

            // Delete former fields from authenticated user
            DB::table('questions')->where('user_id', Auth::user()->id)->delete();


            $file = fopen($request->file('csv'), "r");
            // Stores data in table using Eloquent
            $list_data = [];
            while (($csv_data = fgetcsv($file, null, ";")) !== FALSE)
            {

                $question = new Questions;
                $question->user_id = Auth::user()->id;
                $question->rubrique = $this->convert($csv_data[0]);
                $question->question = $this->convert($csv_data[1]);
                $question->save();

                array_push($list_data, [$question->user_id, $csv_data[0], $csv_data[1]]);
            }

            // Callback message
            $request->session()->put('ok', 'Le fichier à été transféré dans la base de données');

            return $list_data;
        }

        return false;

    }
}