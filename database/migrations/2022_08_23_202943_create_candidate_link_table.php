<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidate_link', function (Blueprint $table) {
            $table->id();

            $table->foreignId('candidate_id');
            $table->foreign('candidate_id')
                ->references('id')
                ->on('candidates');

            $table->foreignId('link_id');
            $table->foreign('link_id')
                ->references('id')
                ->on('links');

            $table->tinyText('url');

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
        Schema::dropIfExists('candidate_link');
    }
}
