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
            $table->string('case_id')->unique();
            $table->string('team')->required();
            $table->string('shift')->required();
            $table->string('division')->required();
            $table->string('ps')->required();
            $table->string('case_nature')->required();
            $table->datetime('case_date_time')->required();
            $table->string('caller_phone')->required();
            $table->text('case_description')->required();
            $table->string('location')->required();
            $table->string('camera_id')->required();
            $table->text('evidence')->required();
            $table->boolean('finding_remarks')->required();
            $table->string('pco_names')->required();
            $table->Longtext('images')->required();
            $table->string('cro')->nullable();
            $table->string('face_trace')->required();
            $table->string('anpr_passing')->required();
            $table->string('culprit')->nullable();
            $table->string('fir_number')->nullable();
            $table->string('feedback')->nullable();
            $table->string('user_id')->required();
            $table->string('user_ip')->required();
            $table->string('field_force')->boolean()->default(false);
            $table->string('local_cameras')->nullable();
            $table->string('user_hostname')->required();
            $table->enum('status', array('pending', 'valid', 'invalid'))->default('pending');
            $table->string('user_email')->required();
            $table->string('gang_name')->nullable();
            $table->string('supervisor_id')->default(null)->nullable();
            $table->string('pco_id')->default(null)->nullable();
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
