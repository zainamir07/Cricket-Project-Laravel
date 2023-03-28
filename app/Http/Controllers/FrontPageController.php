<?php

namespace App\Http\Controllers;

use App\Models\ClubManager;
use App\Models\Event;
use App\Models\MatchRequest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontPageController extends Controller
{
    public function index(){
        $events = Event::orderBy('event_id', 'desc')->where('event_status', '=', 'A')->where('event_type', '=', 'E')->get();
        $news = Event::orderBy('event_id', 'desc')->where('event_status', '=', 'A')->where('event_type', '=', 'N')->get();
        $allEvents = Event::orderBy('event_id', 'desc')->where('event_status', '=', 'A')->get();
        $data = compact('events', 'news', 'allEvents');
        return view('home')->with($data);
    }

    public function viewEvent($id){
        if($id == 'E'){
        $events = Event::orderBy('event_id', 'desc')->where('event_type', '=', 'E')->where('event_status', '=', 'A')->get();
        }elseif($id == 'N'){
        $events = Event::orderBy('event_id', 'desc')->where('event_type', '=', 'N')->where('event_status', '=', 'A')->get();
        }elseif($id != ""){
            $events = Event::where('event_id', '=', $id)->where('event_type', '=', 'E')->where('event_status', '=', 'A')->get();
        }else{
            $events = Event::orderBy('event_id', 'desc')->where('event_status', '=', 'A')->get();
        }
        $data = compact('events');
        return view('events')->with($data);
    }

    public function viewAllEvents(){
        $events = Event::orderBy('event_id', 'desc')->where('event_status', '=', 'A')->get();
        $data = compact('events');
        return view('events')->with($data);
    }
    public function contact(){
        return view('contact');
    }


    public function dashboard(){
        $id = Auth::guard('clubManager')->user()->id;
        $teams = Team::orderBy('team_id', 'desc')->where('team_ClubID', '=', $id)->get();
        $totalTeams = count($teams);
        $matches = MatchRequest::where('match_request_byClubID', '=', $id)->orWhere('match_request_againstClubID', '=', $id)->where('matchRequestByTeamID', '=', $id)->orwhere('matchRequestAgainstTeamID', '=', $id)->get();
        $totalMatches = count($matches);
        // echo "<pre>";
        // print_r($matches->toArray());
        // die;
        $data = compact('teams', 'totalTeams', 'matches', 'totalMatches');
        return view('dashboard')->with($data);
    }

    public function profile(){
        if(Auth::guard('clubManager')->check()){
            $id = Auth::guard('clubManager')->user()->id;
            $club =  ClubManager::where('id', '=', $id)->first();
            $data = compact('club'); 
            return view('profile')->with($data);
        }
    }

    public function editProfile($id){
        if(Auth::guard('clubManager')->check()){
            $id = Auth::guard('clubManager')->user()->id;
            $club =  ClubManager::where('id', '=', $id)->first();
            $data = compact('club'); 
            return view('editProfile')->with($data);
        }
    }

    public function updateProfile(Request $request, $id){
        $request->validate([
           'club_name' => 'required',
           'club_email' => 'required|email',
           'club_address' => 'required',
           'club_contact' => 'required',
        ]);
      $club = ClubManager::where('id', '=', $id)->first();
      $club->name = $request['club_name'];
      $club->email = $request['club_email'];
      $club->address = $request['club_address'];
      $club->contact = $request['club_contact'];
      
      if($request['club_image'] != ""){
        $imageName = time().".".$request->file('club_image')->extension();
        $request->file('club_image')->move(public_path('Backend/club_images'), $imageName);
        $club->image = $imageName;
        }else{
          $club->image = $club->image;
        }

        $club->update();
        if($club){
            return redirect()->route('profile')->with('success', 'Profile has been Updated');
        }else{
            return redirect()->route('profile')->with('error', 'Something Went Wrong');
        }

    }

    public function changePassword(){
        return view('changePassword');
    }
}
