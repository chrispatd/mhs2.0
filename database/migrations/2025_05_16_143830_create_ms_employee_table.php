<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ms_employee', function (Blueprint $table) {
            $table->increments('employee_id');
            $table->unsignedInteger('position_id')->index();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('gender', 6);
            $table->string('teacher_code', 20)->nullable();
            $table->unsignedInteger('religion_id')->index();
            $table->string('status', 50);
            $table->string('phone', 20);
            $table->string('address', 200);
            $table->string('profile_picture', 150)->default('default-avatar.png');
            $table->string('profile_cover', 150)->nullable()->default('default-cover.jpg');
            $table->string('signature_picture', 255)->nullable();
            $table->double('signature_margin_top')->nullable();
            $table->double('signature_margin_left')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps(0);

            // optionally, if you have FK tables:
            // $table->foreign('position_id')->references('position_id')->on('ms_employee_position');
            // $table->foreign('religion_id')->references('religion_id')->on('ms_religion');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_employee');
    }
}
