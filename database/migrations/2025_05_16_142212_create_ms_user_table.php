<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMsUserTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ms_user', function (Blueprint $table) {
            $table->increments('user_id');
            $table->unsignedInteger('role_id')->nullable()->index();
            $table->unsignedInteger('role_access_id')->nullable();
            $table->unsignedInteger('employee_id')->nullable()->index();
            $table->string('teacher_code', 20)->nullable();
            $table->string('code_type', 50)->nullable();
            $table->boolean('is_homeroomteacher')->default(false);
            $table->boolean('is_super_user')->default(false);
            $table->boolean('is_score_spiritual')->default(false);
            $table->boolean('is_score_sosial')->default(false);
            $table->string('ppdb_access', 255)->nullable();
            $table->string('email', 100);
            $table->string('username', 100);
            $table->string('password', 100);
            $table->unsignedInteger('active_semester_id')->nullable()->index();
            $table->unsignedInteger('active_school_year_id')->nullable()->index();
            $table->dateTime('last_login')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps(0); // created_at & updated_at, tanpa precision
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_user');
    }
}
