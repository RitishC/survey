<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $table = 'question';
  protected $casts = [
      'option_name' => 'array',
  ];

  protected $fillable = ['title', 'question_type', 'option_name', 'user_id', 'question_category_id'];

  public function survey() {
    return $this->belongsTo(Survey::class);
  }

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function answers() {
    return $this->hasMany(Answer::class);
  }

  public function category() {
    return $this->belongsTo(QuestionCategory::class, 'question_category_id');
  }
}
