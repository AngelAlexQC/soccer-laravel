<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMatchesTable extends Migration
{
    public function up()
    {
        Schema::table('matches', function (Blueprint $table) {
            $table->unsignedBigInteger('championship_id');
            $table->foreign('championship_id', 'local_fk_4344601')->references('id')->on('championships');
            $table->unsignedBigInteger('local_id');
            $table->foreign('local_id', 'local_fk_4344687')->references('id')->on('enrollments');
            $table->unsignedBigInteger('away_id');
            $table->foreign('away_id', 'away_fk_4344688')->references('id')->on('enrollments');
        });
    }
}
