<?php

namespace App\Http\Controllers;

use App\Models\ClubManager;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    
    public function index($id){
     $teams = Team::where('team_clubID', '=', $id)->get();
     $club = ClubManager::where('id', '=', $id)->first();
     $data = compact('teams', 'club');
     return view('admin.teams')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'clubTeam_name' => 'required',
            'clubTeam_category' => 'required',
            'clubTeam_description' => 'required',
        ]);
          $team = new Team;
          $team->team_name = $request['clubTeam_name'];
          $team->team_category = $request['clubTeam_category'];
          $team->team_description = $request['clubTeam_description'];
          $team->team_clubID = $request['club_id'];
          $team->save();
        if($team){
            return redirect()->back()->with('success', 'Team has beed added successfully');
        }else{
            return redirect()->back()->with('success', 'Team has beed added successfully');
        }

    }

    public function edit($id){
        $team = Team::find($id);
        $data = compact('team');
        return view('admin.editTeam')->with($data);
    }

    public function update($id, Request $request){
        $request->validate([
            'team_name' => 'required',
            'team_category' => 'required',
            'team_description' => 'required',
        ]);
            $team = Team::find($id);
            $team->team_name = $request['team_name'];
            $team->team_category = $request['team_category'];
            $team->team_description = $request['team_description'];
            $team->team_status = $request['team_status'];
            // echo '<pre>';
            // print_r($team->toArray());
            // die;
            $team->update();
            if($team){
                return redirect()->back()->with('success', 'Club has been Updated');
            }else{
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
    }

    public function delete($id){
        $team = Team::find($id);
        $team->delete();
        return redirect()->back()->with('success', 'Team Has Been Deleted');
    }


}
