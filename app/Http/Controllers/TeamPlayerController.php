<?php

namespace App\Http\Controllers;

use App\Models\ClubManager;
use App\Models\PlayerCategory;
use App\Models\Team;
use App\Models\TeamPlayers;
use App\Models\User;
use Illuminate\Http\Request;

class TeamPlayerController extends Controller
{
    
    public function index($team_id, $club_id){
        $teamPlayers = TeamPlayers::where('team_player_clubID', '=', $club_id)->where('team_player_teamID', '=', $team_id)->get();
        $category = PlayerCategory::all();
        $team = Team::where('team_id', '=', $team_id)->first();
        $teamName = $team->team_name;
        $club = ClubManager::where('id', '=', $club_id)->first();
        $data = compact('teamPlayers', 'teamName', 'category', 'club', 'team');
        return view('admin.teamMembers')->with($data);
    } 

    public function get_member_by_category_id(Request $request){
       $cateId = $request['playerCateID'];
       $clubId = $request['clubId'];
       $players = User::where('role', '=', 'U')->where('user_clubManagerID', '=', $clubId)->where('user_categoryID', '=', $cateId)->get();
      
       $data = compact('players');
       return response()->json([
          'players' => $players,
       ]);
    }

    public function add_new_teamMember(Request $request){
        $request->validate([
          'team_playerCategory' => 'required',
          'team_clubMembers' => 'required',
        ]);

        $teamMember = new TeamPlayers;
        $teamMember->team_player_clubID = $request['clubId'];
        $teamMember->team_player_memberID = $request['team_clubMembers'];
        $teamMember->team_player_teamID = $request['teamId'];
        // echo '<pre>';
        // print_r($teamMember->toArray());
        // die;
        $teamMember->save();
        if($teamMember){
            return redirect()->back()->with('success', 'Member has been Added');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function delete_teamMember($id){
        $teamPlayer = TeamPlayers::find($id);
        $teamPlayer->delete();
        return redirect()->back()->with('success', 'Member has been Deleted');
    }

    // Team Members Function For Club Manager 
    public function club_teamMembers($teamid, $clubid){
        $teamPlayers = TeamPlayers::where('team_player_clubID', '=', $clubid)->where('team_player_teamID', '=', $teamid)->get();
        $team = Team::where('team_id', '=', $teamid)->first();
        $teamName = $team->team_name;
        $club = ClubManager::where('id', '=', $clubid)->first();
        $category = PlayerCategory::all();
        $data = compact('teamPlayers', 'team', 'club', 'teamName', 'category');
        return view('teamMembers')->with($data);
    }
}
