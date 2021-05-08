<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectVoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_vote', function (Blueprint $table) {
            $table->foreignId('subject_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('vote_id')->nullable()->constrained()->cascadeOnDelete();
            $table->primary(['subject_id', 'vote_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_vote');
    }
}
