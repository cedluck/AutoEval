<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    protected $table = 'questions';

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function results()
    {
        return $this->hasMany('App\Results', 'question_id');
    }
}
