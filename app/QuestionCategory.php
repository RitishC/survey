<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCategory extends Model
{
    protected $fillable = ['category_name'];
    protected $table = 'question_category';

    public function questions() {
        return $this->hasMany(Question::class);
    }

}
