<?php

namespace App\Http\Controllers;

use App\Models\MatchDetails;
use App\Models\MatchRequest;
use App\Models\Team;
use App\Models\TeamPlayers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(){
      return view('userLogin');
    }

    public function loginAuth(Request $request){
      $request->validate([
        'email' => 'required|email',
        'password' => 'required',
      ]);
      $input = $request->all();
      if(Auth::guard('web')->attempt(['email' => $input['email'], 'password' => $input['password']])){
        return redirect()->route('home');
     }else{
      return redirect()->view('userLogin')->with('error', 'Something went Wrong');
     }
    }

    public function dashboard(){
        $id = Auth::guard('web')->user()->id;
        $teams = TeamPlayers::orderBy('team_player_id', 'desc')->where('team_player_memberID', '=', $id)->get();
        $totalTeams = count($teams);
        $matches = MatchDetails::where('match_detail_playerID', '=', $id)->get();
        $totalMatches = count($matches);
        // echo "<pre>";
        // print_r($matches->toArray());
        // die;
        $data = compact('teams', 'totalTeams', 'matches', 'totalMatches');
        return view('userDashboard')->with($data);
    }
}
