<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAttendQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attend_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('question');
            $table->unsignedBigInteger('user_test_result_id');
            $table->foreign('user_test_result_id')->references('id')->on('user_test_results')->onUpdate('cascade')->onDelete('cascade');
            $table->string('correct_ans')->nullable();
            $table->string('selected_ans')->nullable();
            $table->boolean('is_correct')->default(0);
            $table->enum('type',['boolean','multiple'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_attend_questions');
    }
}
