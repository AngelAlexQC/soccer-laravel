<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToEnrollmentsTable extends Migration
{
    public function up()
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->unsignedBigInteger('championship_id');
            $table->foreign('championship_id', 'championship_fk_4344677')->references('id')->on('championships');
            $table->unsignedBigInteger('club_id');
            $table->foreign('club_id', 'club_fk_4344678')->references('id')->on('clubs');
        });
    }
}
