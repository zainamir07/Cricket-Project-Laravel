<?php

namespace App\Http\Controllers;

use App\Models\MatchDetails;
use App\Models\MatchRequest;
use App\Models\User;
use Illuminate\Http\Request;

class PlayerMatchDetails extends Controller
{
    public function index($playerid, $matchid){
        // $match = MatchRequest::where('match_request_id', '=', $matchid)->first();
        // $user = User::where('id', '=', $playerid)->first();
        // $playerDetails = MatchDetails::where('match_detail_playerID', '=', $playerid)->where('match_detail_matchID', '=', $matchid)->first();
        // $playerID = $playerid;
        // $matchID = $matchid;
        // echo $playerid;
        // echo '<br>';
        // echo $matchid;
        // die;
        $data = compact('playerid', 'matchid');    
        return view('addPlayerDetails')->with($data);

    }

    public function storePlayerDetails($playerid, $matchid, Request $request){
       $request->validate([
         'totalOvers' => 'required',
         'scoreInOvers' => 'required',
         'totalWickets' => 'required',
         'playerStatus' => 'required',
         'ballsPlayed' => 'required',
         'scoreInBatting' => 'required',
         'playerPosition' => 'required',
         'winningAwards' => 'required',
         'winningAwardDesc' => 'required',
       ]);

       $playerDetails = new MatchDetails;
       $playerDetails->match_detail_matchID = $matchid;
       $playerDetails->match_detail_playerID = $playerid;
       $playerDetails->match_detail_player_overs = $request['totalOvers'];
       $playerDetails->match_detail_player_overs_score = $request['scoreInOvers'];
       $playerDetails->match_detail_player_wickets = $request['totalWickets'];
       $playerDetails->match_detail_player_out_status = $request['playerStatus'];
       $playerDetails->match_detail_player_balls = $request['ballsPlayed'];
       $playerDetails->match_detail_player_score = $request['scoreInBatting'];
       $playerDetails->match_detail_player_position = $request['playerPosition'];
       $playerDetails->match_detail_player_award = $request['winningAwards'];
       $playerDetails->match_detail_player_award_desc = $request['winningAwardDesc'];
       $playerDetails->save();
       if($playerDetails){
        return redirect('matchDetails/'.$matchid)->with('success', 'Player Performance Added Successfully');
       }else{
        return redirect('matchDetails/'.$matchid)->with('error', 'Something Went Wrong');
       }
    }

    public function editPlayerDetails($playerid, $matchid){
        $playerDetails = MatchDetails::where('match_detail_matchID', '=', $matchid)->where('match_detail_playerID', '=', $playerid)->first();
        $data = compact('playerDetails', 'playerid', 'matchid');
        return view('updatePlayerdetails')->with($data);
    }

    public function updatePlayerDetails($playerid, $matchid, Request $request){
        $request->validate([
            'totalOvers' => 'required',
            'scoreInOvers' => 'required',
            'totalWickets' => 'required',
            'playerStatus' => 'required',
            'ballsPlayed' => 'required',
            'scoreInBatting' => 'required',
            'playerPosition' => 'required',
            'winningAwards' => 'required',
            'winningAwardDesc' => 'required',
          ]);
        //   echo '<pre>';
        //  print_r($request->toArray());
        //  die;
        //  $playerDetail = MatchDetails::where('match_detail_matchID', '=', $matchid)->where('match_detail_playerID', '=', $playerid)->first();
        //  $detailID = $playerDetail->match_detail_id;
        //  echo '<pre>';
        //  print_r($playerDetail);
        //  die;
        $playerDetails = MatchDetails::where('match_detail_matchID', '=', $matchid)->where('match_detail_playerID', '=', $playerid)->first();
        $playerDetails->match_detail_matchID = $matchid;
        $playerDetails->match_detail_playerID = $playerid;
        $playerDetails->match_detail_player_overs = $request['totalOvers'];
        $playerDetails->match_detail_player_overs_score = $request['scoreInOvers'];
        $playerDetails->match_detail_player_wickets = $request['totalWickets'];
        $playerDetails->match_detail_player_out_status = $request['playerStatus'];
        $playerDetails->match_detail_player_balls = $request['ballsPlayed'];
        $playerDetails->match_detail_player_score = $request['scoreInBatting'];
        $playerDetails->match_detail_player_position = $request['playerPosition'];
        $playerDetails->match_detail_player_award = $request['winningAwards'];
        $playerDetails->match_detail_player_award_desc = $request['winningAwardDesc'];
        $playerDetails->update();
        // echo "<pre>";
        // print_r($playerDetails->toArray());
        // die;
        if($playerDetails){
            return redirect('matchDetails/'.$matchid)->with('success', 'Player Performance Updated Successfully');
        }else{
            return redirect('matchDetails/'.$matchid)->with('error', 'Something Went Wrong');
        }
   
    }
}
