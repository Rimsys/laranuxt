<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id');
            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates');

            $table->foreignId('language_id');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages');

            $table->string('role');
            $table->text('presentation');

            $table->softDeletes();
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
        Schema::dropIfExists('resumes');
    }
}
