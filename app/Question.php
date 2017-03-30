<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// maak klasse van vragen aan 
class Question extends Model
{
  protected $casts = [
      'option_name' => 'array',
  ];
  // invulmogelijkheden
  protected $fillable = ['title', 'question_type', 'option_name', 'user_id'];
  public function survey() {
    return $this->belongsTo(Survey::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function answers() {
    return $this->hasMany(Answer::class);
  }
  
  protected $table = 'question';

}