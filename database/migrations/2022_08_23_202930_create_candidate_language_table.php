<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_language', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id');
            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates');

            $table->foreignId('language_id');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages');

            $table->foreignId('language_level_id');
            $table->foreign('language_level_id')
                ->references('id')
                ->on('language_levels');

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
        Schema::dropIfExists('candidate_language');
    }
}
