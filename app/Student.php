<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'classes';

    protected $guard = 'student';
    
    protected $fillable = [
        'name', 'password', 'teacher_id', 'remember_token'
    ];

    public $timestamps = false;

    public function teacher() {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }

    public function results() 
    {
        return $this->hasMany('App\Results', 'student_id')->orderBy('id', 'desc');
    }

    // convert str to UTF-8 charset
    public function convert( $str ) {
        return iconv( "Windows-1252", "UTF-8", $str );
    }

    /* Remplace l'identifiant par le nom de l'élève si la variable de session existe  */
    public function IsNameStudent() {
        if(session()->has('students')) {
            $students = session('students');
//            dd($students);
            if(array_key_exists($this->name, $students)) {
                return $this->convert($students[$this->name]);
            }
        }

        return $this->name;
    }
}
