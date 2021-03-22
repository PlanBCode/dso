<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectSuggestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_suggestions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->nullable()->constrained();
            $table->string('title');
            $table->text('description');
            $table->text('importance');
            $table->text('skills')->nullable();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email');
            $table->boolean('agree_to_terms');
            $table->boolean('email_confirmed')->default(false);
            $table->string('email_confirmation_code');
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
        Schema::dropIfExists('subject_suggestions');
    }
}
