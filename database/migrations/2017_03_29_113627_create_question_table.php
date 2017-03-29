<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
// klasse voor aanmaken van vragen
class CreateQuestionTable extends Migration
{
    /**
     * 
     *
     * @return void
     */
    // functie voor toevoegen van vraag
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('survey_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->string('title');
            $table->string('question_type');
            $table->string('option_name')->nullable();
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
        Schema::drop('question');
    }
}