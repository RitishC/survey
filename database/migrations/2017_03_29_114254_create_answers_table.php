<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// klasse voor antwoorden van vraag

class CreateAnswersTable extends Migration
{
    /**
     * 
     *
     * @return void
     */
    //functie voor antwoorden
    public function up()
    {
        Schema::create('Answer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('question_id');
            $table->integer('survey_id');
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * 
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('Answer');
    }
}