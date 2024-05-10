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
            $table->string('team');
            $table->string('shift');
            $table->string('division');
            $table->string('ps');
            $table->string('case_nature');
            // $table->date('date');
            $table->time('time');
            $table->string('caller_phone');
            $table->text('case_description');
            $table->string('location');
            $table->string('camera_id');
            $table->text('evidence');
            $table->text('finding_remarks');
            $table->string('pco_names');
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
