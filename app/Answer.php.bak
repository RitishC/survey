<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// antwoorden klass aangemaakt
class Answer extends Model
{
    protected $fillable = ['answer'];
    protected $table = 'answer';

    public function survey() {
      return $this->belongsTo(Survey::class);
    }

    public function question() {
      return $this->belongsTo(Question::class);
    }
}