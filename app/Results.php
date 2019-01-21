<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Results extends Model
{
    protected $table = 'results';

    public $timestamps = false;

    public function student() {
        return $this->belongsTo('App\Classes', 'student_id');
    }

    public function question() {
        return $this->belongsTo('App\Questions', 'question_id');
    }
}
