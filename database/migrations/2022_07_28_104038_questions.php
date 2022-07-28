<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Questions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quiz_id'); 
            $table->LongText('question');
            $table->LongText('image')->nullable();
            $table->LongText('answer1');
            $table->LongText('answer2');
            $table->LongText('answer3');
            $table->LongText('answer4');
            $table->enum('correct_answer',['answer1','answer2','answer3','answer4',]);
            $table->timestamps();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
