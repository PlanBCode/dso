<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectVotingRoundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_voting_round', function (Blueprint $table) {
            $table->foreignId('subject_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('voting_round_id')->nullable()->constrained()->cascadeOnDelete();
            $table->primary(['subject_id', 'voting_round_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_voting_round');
    }
}
