<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('voting_round_id')->constrained();
            $table->foreignId('subject_id')->constrained();
            $table->string('email');
            $table->text('why_important')->nullable();
            $table->boolean('agree_to_terms');
            $table->text('extra')->nullable();
            $table->boolean('disabled')->default(false);

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
        Schema::dropIfExists('votes');
    }
}
