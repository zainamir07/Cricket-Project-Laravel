<?php

namespace App\Http\Controllers;

use App\Models\ClubManager;
use App\Models\Ground;
use App\Models\MatchDetails;
use App\Models\MatchRequest;
use App\Models\Team;
use App\Models\TeamPlayers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchesController extends Controller
{
    public function clubMatches(){
        $clubID = Auth::guard('clubManager')->user()->id;
        $clubs = ClubManager::where('id', '!=', $clubID)->get();
        $myTeams = Team::where('team_clubID', '=', $clubID)->get();
        $requestSend = MatchRequest::where('match_request_byClubID', '=', $clubID)->get();
        $requestRecieve = MatchRequest::where('match_request_againstClubID', '=', $clubID)->get();
        $data = compact('clubs', 'myTeams', 'requestSend', 'requestRecieve');
        return view('matches')->with($data);
    }

    public function sendNewMatchRequest(Request $request){
       $request->validate([
         'matchRequestTitle' => 'required',
         'matchRequestAgainstClub' => 'required',
         'matchRequestCategory' => 'required',
         'matchRequesTeam' => 'required',
         'matchRequestOvers' => 'required',
         'matchRequestDescription' => 'required',
       ]);
       $clubID = Auth::guard('clubManager')->user()->id;
       $match = New MatchRequest;
       $match->match_request_byClubID = $clubID;
       $match->match_request_againstClubID = $request['matchRequestAgainstClub'];
       $match->matchRequestByTeamID = $request['matchRequesTeam'];
       $match->match_request_category = $request['matchRequestCategory'];
       $match->match_request_title = $request['matchRequestTitle'];
       $match->match_request_description = $request['matchRequestDescription'];
       $match->match_request_overs = $request['matchRequestOvers'];
       $match->match_request_status  = 'P';
       $match->save();
       if($match){
        return redirect()->route('clubMatches')->with('success', 'Your Request Has Been Send');
       }else{
        return redirect()->route('clubMatches')->with('error', 'Something went wrong');
       }
    //    echo '<pre>';
    //    print_r($match->toArray());
    //    die;
    }

    public function matchRequestPage($requestID){
      $clubID = Auth::guard('clubManager')->user()->id;
      $matchDetails = MatchRequest::where('match_request_id', '=', $requestID)->first();
      if($matchDetails->match_request_groundID != ""){
        $groundID = $matchDetails->match_request_groundID;
        $ground = Ground::where('ground_id', '=', $groundID)->first();
      }else{
        $ground = '';
      }
      $receiverTeams = Team::where('team_clubID', '=', $matchDetails->match_request_againstClubID)->get();
      $senderTeamID = $matchDetails->matchRequestByTeamID;
      $senderPlayers = TeamPlayers::where('team_player_teamID', '=', $senderTeamID)->get();
      $recieverTeamID = $matchDetails->matchRequestAgainstTeamID;
      $receiverPlayers = TeamPlayers::where('team_player_teamID', '=', $recieverTeamID)->get();
      $senderId = $matchDetails->match_request_byClubID;
      $recieverId = $matchDetails->match_request_againstClubID;
      // $playerDetails = MatchDetails::where('match_detail_matchID', '=', $matchDetails->match_request_id)->where('match_detail_playerID', '=', )
      // $senderMembers = User::where('')
      $data = compact('matchDetails', 'ground', 'receiverTeams', 'senderPlayers', 'receiverPlayers');
      return view('matchDetails')->with($data);
    }

    public function acceptRequest(Request $request){
      $request->validate([
         'matchRequestAgainstClubTeamID' => 'required',
      ]);
      $id = $request['requestID'];
      $matchRequest = MatchRequest::find($id);
      
      $matchRequest->matchRequestAgainstTeamID = $request['matchRequestAgainstClubTeamID'];
      $matchRequest->match_request_status = 'AP';
      // echo '<pre>';
      // print_r($matchRequest->toArray());
      // // print_r($matchRequest->toArray());
      // die;
      $matchRequest->update();
      if($matchRequest){
        return redirect()->back()->with('success', 'Request Accepted, Wait For Admin Approval');
      }else{
        return redirect()->back()->with('success', 'Something Went Wrong');
      }
    }

    public function admin_viewMatches(){
      $matches = MatchRequest::orderBy('match_request_id', 'desc')->get();
      $data = compact('matches');
      return view('admin.viewMatches')->with($data);
    }

    public function admin_matchDetails($id){
      $matchDetails = MatchRequest::where('match_request_id', '=', $id)->first();
      if($matchDetails->match_request_groundID != ""){
        $groundID = $matchDetails->match_request_groundID;
        $ground = Ground::where('ground_id', '=', $groundID)->first();
      }else{
        $ground = '';
      }
      $receiverTeams = Team::where('team_clubID', '=', $matchDetails->match_request_againstClubID)->get();
      $senderTeamID = $matchDetails->matchRequestByTeamID;
      $senderPlayers = TeamPlayers::where('team_player_teamID', '=', $senderTeamID)->get();
      $recieverTeamID = $matchDetails->matchRequestAgainstTeamID;
      $receiverPlayers = TeamPlayers::where('team_player_teamID', '=', $recieverTeamID)->get();
      $senderId = $matchDetails->match_request_byClubID;
      $recieverId = $matchDetails->match_request_againstClubID;
      $allGrounds = Ground::orderBy('ground_id', 'desc')->get();
      // $senderMembers = User::where('')
      $data = compact('matchDetails', 'ground', 'receiverTeams', 'senderPlayers', 'receiverPlayers','allGrounds');
      return view('admin.matchDetails')->with($data);
    }

    public function admin_matchGroundUpdate(Request $request, $id){
         $request->validate([
            'groundID' => 'required',
            'setDate' => 'required',
            'setTime' => 'required',
         ]);
         $matchRequest = MatchRequest::find($id);
         $matchRequest->match_request_groundID = $request['groundID'];
         $matchRequest->match_request_dayDate = $request['setDate'];
         $matchRequest->match_request_dayTime = $request['setTime'];
         $matchRequest->match_request_status = 'A';
         $matchRequest->update();
         if($matchRequest){
          return redirect()->back()->with('success', 'Ground Updated Successfully');
        }else{
          return redirect()->back()->with('success', 'Something Went Wrong');
        }
    }

    public function admin_matchWinningAnnounce(Request $request, $id){
      $request->validate([
        'winTeamID' => 'required',
        'winByRuns' => 'required',
        'winByWickets' => 'required',
      ]);
      // echo '<pre>';
      // print_r($request->toArray());
      // die;
      $matchRequest = MatchRequest::find($id);
      $matchRequest->match_request_winningTeam = $request['winTeamID'];
      $matchRequest->match_request_winByRuns = $request['winByRuns'];
      $matchRequest->match_request_winByWickets = $request['winByWickets'];
      $matchRequest->update();
      if($matchRequest){
        return redirect()->back()->with('success', 'Announcement Successfully Updated');
      }else{
        return redirect()->back()->with('success', 'Something Went Wrong');
      }
    }

}
