<?php

use App\Models\Club;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->integer('minute')->nullable();
            $table->string('description')->nullable();
            $table->foreignId('club_id')->on('enrollments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
