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
        Schema::create('match_details', function (Blueprint $table) {
            $table->id('match_detail_id');
            $table->string('match_detail_matchID');
            $table->string('match_detail_playerID');
            $table->float('match_detail_player_overs');
            $table->string('match_detail_player_overs_score');
            $table->string('match_detail_player_balls');
            $table->string('match_detail_player_score');
            $table->string('match_detail_player_wickets');
            $table->enum('match_detail_player_out_status', ['O', 'NO', 'NP']);
            $table->string('match_detail_player_position');
            $table->string('match_detail_player_award_desc');
            $table->enum('match_detail_player_award', ['MOM', 'SOM', 'COM']);
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
        Schema::dropIfExists('match_details');
    }
};
