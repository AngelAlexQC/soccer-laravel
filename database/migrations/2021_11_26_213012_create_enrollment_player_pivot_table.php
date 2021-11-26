<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnrollmentPlayerPivotTable extends Migration
{
    public function up()
    {
        Schema::create('enrollment_player', function (Blueprint $table) {
            $table->unsignedBigInteger('enrollment_id');
            $table->foreign('enrollment_id', 'enrollment_id_fk_4344682')->references('id')->on('enrollments')->onDelete('cascade');
            $table->unsignedBigInteger('player_id');
            $table->foreign('player_id', 'player_id_fk_4344682')->references('id')->on('players')->onDelete('cascade');
        });
    }
}
