<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('enrollment_user', function (Blueprint $table) {
            $table->unsignedBigInteger('enrollment_id');
            $table->foreign('enrollment_id', 'enrollment_id_fk_4344682')->references('id')->on('enrollments')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_4344682')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
