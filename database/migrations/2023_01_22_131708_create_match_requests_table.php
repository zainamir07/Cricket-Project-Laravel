<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('match_requests', function (Blueprint $table) {
            $table->id('match_request_id');
            $table->string('match_request_byClubID');
            $table->string('match_request_againstClubID')->nullable();
            $table->string('matchRequestByTeamID');
            $table->string('matchRequestAgainstTeamID')->nullable();
            $table->enum('match_request_category', ['T', 'H']);
            $table->enum('match_request_overs', ['SS', 'T20', '1D', 'T']);
            $table->string('match_request_title');
            $table->text('match_request_description');
            $table->string('match_request_dayDate')->nullable();
            $table->string('match_request_dayTime')->nullable();
            $table->unsignedBigInteger('match_request_groundID')->nullable();
            $table->foreign('match_request_groundID')->references('ground_id')->on('grounds');
            $table->enum('match_request_status', ['P', 'A', 'R', 'C']);
            $table->string('match_request_winningTeam')->nullable();
            $table->string('match_request_winByRuns')->nullable();
            $table->string('match_request_winByWickets')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('match_requests');
    }
};
