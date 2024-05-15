<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('d_i_r_s', function (Blueprint $table) {
            $table->id();
            $table->string('team')->required();
            $table->string('shift')->required();
            $table->string('division')->required();
            $table->string('ps')->required();
            $table->string('case_nature')->required();
            // $table->date('date')->required();
            $table->time('time')->required();
            $table->string('caller_phone')->required();
            $table->text('case_description')->required();
            $table->string('location')->required();
            $table->string('camera_id')->required();
            $table->text('evidence')->required();
            $table->text('finding_remarks')->required();
            $table->string('pco_names')->required();
            $table->string('images')->required();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('d_i_r_s');
    }
};
