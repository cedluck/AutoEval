<?php

namespace App\Http\Controllers;

use App\Http\Requests\CsvRequest;
use App\Models\CsvGestion\CsvGestionInterface;

use App\User;
use Illuminate\Support\Facades\Auth;


class CsvController extends Controller
{
    protected $csv_data;

    /**
     * CsvController constructor.
     * Only authorised users
     */
    public function __construct()
    {

        $this->middleware('auth');
    }


    /**
     * Displays the form
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('teacher.csv');
    }


    /**
     * Process the form validation and displays appropriate views
     *
     * @param CsvRequest $request : sets the file rules
     * @param CsvGestionInterface $csvgestion  : injected model that stores data in table
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postForm(CsvRequest $request, CsvGestionInterface  $csvgestion)
    {

        if($csvgestion->save($request))
        {
            $csv_data = User::find(Auth::user()->id)->questions;

            return view('teacher.csvrender', compact('csv_data'));
        }
        else
        {
            return view('teacher.csv');
        }


    }
}
