<?php

namespace App\Http\Controllers;

use App\Models\ClubManager;
use App\Models\Coach;
use App\Models\Event;
use App\Models\PlayerCategory;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ClubManagerController extends Controller
{
    public function index(){
        return view('home');
    }

    public function login(){
        return view('clubLogin');
    }
    public function loginAuth(Request $request){
       $request->validate([ 
            'email' => 'required|email',
            'password' => 'required',
       ]);
       $input = $request->all(); 
    //    dd(Auth::guard('clubManager'));
    //    dd($request->all());
       if(Auth::guard('clubManager')->attempt(['email' => $input['email'], 'password' => $input['password']])){
          return redirect()->route('home');
       }else{
        return redirect()->route('club.login')->with('error', 'Something went Wrong');
       }
    }

    public function logout(){
        if(Auth::guard('clubManager')->check()) // this means that the admin was logged in.
        {
            Auth::guard('clubManager')->logout();
            return redirect()->route('home');
        }
    }

    public function clubMembers(){
        $id = Auth::guard('clubManager')->user()->id;
        $members = User::orderBy('id', 'desc')->where('user_clubManagerID', '=', $id)->get();
        $club = ClubManager::where('id', '=', $id)->first();
        $category = PlayerCategory::all();
        $data = compact('members', 'club', 'category');
        return view('clubMembers')->with($data);
    }
    
    public function addMember(Request $request){
        $request->validate([
            'clubMember_name' => 'required',
            'clubMember_email' => 'required',
            'clubMember_address' => 'required',
            'clubMember_contact' => 'required',
            'clubMember_image' => 'required',
            'clubMember_category' => 'required',
            'clubMember_password' => 'required',
        ]);
            $imageName = time().".".$request->file('clubMember_image')->extension();
            $request->file('clubMember_image')->move(public_path('Backend/club_images'), $imageName);
     
            $club = new User;
            $club->name = $request['clubMember_name'];
            $club->email = $request['clubMember_email'];
            $club->address = $request['clubMember_address'];
            $club->contact = $request['clubMember_contact'];
            $club->user_clubManagerID = $request['clubManager_id'];
            $club->user_categoryID = $request['clubMember_category'];
            $club->role = 'U';
            $club->password = md5($request['clubMember_password']);
            $club->image = $imageName;
            $club->save();
            if($club){
                return redirect()->back()->with('success', 'Club Member has been added');
            }else{
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
    }

    public function editClubMember($id){
        $member = User::find($id);
            $memberName = $member->name;
            $data = compact('member', 'memberName');
            return view('editClubMember')->with($data);
    }

    
    public function updateClubMember($id, Request $request){
        $request->validate([
            'clubMember_name' => 'required',
            'clubMember_email' => 'required',
            'clubMember_address' => 'required',
            'clubMember_contact' => 'required',
        ]);
            $member = User::find($id);
            $member->name = $request['clubMember_name'];
            $member->email = $request['clubMember_email'];
            $member->contact = $request['clubMember_contact'];
            $member->address = $request['clubMember_address'];
            $member->status = $request['clubMember_status'];
            if($request['clubMember_image'] != ""){
                $imageName = time().".".$request->file('clubMember_image')->extension();
                $request->file('clubMember_image')->move(public_path('Backend/club_images'), $imageName);
                $member->image = $imageName;
            }else{
                $member->image = $member->image;
            }
            // echo '<pre>';
            // print_r($member->toArray());
            // die;
            $member->update();
            if($member){
                return redirect()->route('clubMembers')->with('success', 'Club Member has been Updated');
            }else{
                return redirect()->route('clubMembers')->with('error', 'Something Went Wrong');
            }
    }

    public function deleteClubMember($id){
        $member = User::where('id', '=', $id)->first();
        $img_path = public_path("Backend/club_images/".$member->image);  
        if($member){
            $member->delete();
            File::delete($img_path);
            return redirect()->back()->with('success', 'Club Member has been Deleted');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
    }

    public function myTeams(){
        $id = Auth::guard('clubManager')->user()->id;
        $teams = Team::where('team_clubID', '=', $id)->get();
     $club = ClubManager::where('id', '=', $id)->first();
     $data = compact('teams', 'club');
     return view('teams')->with($data);
    }

    public function addTeam(Request $request){
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
            return redirect()->route('clubTeams')->with('success', 'Team has beed added successfully');
        }else{
            return redirect()->route('clubTeams')->with('success', 'Team has beed added successfully');
        }
    }

    public function editTeam($id){
        $team = Team::find($id);
        $data = compact('team');
        return view('editTeam')->with($data);
    }

    public function updateTeam($id, Request $request){
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
                return redirect()->route('clubTeams')->with('success', 'Club has been Updated');
            }else{
                return redirect()->route('clubTeams')->with('error', 'Something Went Wrong');
            }
    }

    public function deleteTeam($id){
        $team = Team::find($id);
        $team->delete();
        return redirect()->route('clubTeams')->with('success', 'Team Has Been Deleted');
    }

    public function clubCoaches(){
        $clubid = Auth::guard('clubManager')->user()->id;
        $coaches = Coach::where('coach_clubID', '=', $clubid)->get();
        $category = PlayerCategory::all();
        $club = ClubManager::where('id', '=', $clubid)->first();
        $data = compact('coaches', 'category', 'club');
        return view('coaches')->with($data);
    }

    public function addClubCoach(Request $request){
       
        $request->validate([
          'coach_name' => 'required',
          'coach_category' => 'required',
          'coach_image' => 'required',
        ]);
  
        $imageName = time().".".$request->file('coach_image')->extension();
        $request->file('coach_image')->move(public_path('Backend/user_images'), $imageName);
        $clubid = Auth::guard('clubManager')->user()->id;
        $coach = new Coach;
        $coach->coach_name = $request['coach_name'];
        $coach->coach_category = $request['coach_category'];
        $coach->coach_image = $imageName;
        $coach->coach_clubID = $clubid;
        $coach->save();
        if($coach){
            return redirect()->route('clubCoaches')->with('success', 'Coach has been added');
        }else{
            return redirect()->route('clubCoaches')->with('error', 'Something Went Wrong');
        }
      }

      public function editClubCoach($coachid){
        $coach = Coach::where('coach_id', '=', $coachid)->first();
        $coachClub = $coach->coach_clubID;
        $category = PlayerCategory::all();
        $data = compact('coach', 'category', 'coachClub');
        return view('editCoach')->with($data);
      }
  
      public function updateClubCoach($id, Request $request){
        $request->validate([
            'coach_name' => 'required',
            'coach_category' => 'required',
            'coach_status' => 'required',
        ]);
            $coach = Coach::find($id);
            $coach->coach_name = $request['coach_name'];
            $coach->coach_category = $request['coach_category'];
            $coach->coach_status = $request['coach_status'];
            if($request['coach_image'] != ""){
            $imageName = time().".".$request->file('coach_image')->extension();
            $request->file('coach_image')->move(public_path('Backend/user_images'), $imageName);
            $coach->coach_image = $imageName;
            }else{
              $coach->coach_image = $coach->coach_image;
            }
            $coach->update();
            if($coach){
                return redirect()->route('clubCoaches')->with('success', 'Coach has been Updated');
            }else{
                return redirect()->route('clubCoaches')->with('error', 'Something Went Wrong');
            }
    }
  
    public function deleteClubCoach($id){
      $coach = Coach::where('coach_id', '=', $id)->first();
      $coachImage = $coach->coach_image;
      $img_path = public_path("Backend/user_images/".$coachImage);  
      if($coach){
          $coach->delete();
          File::delete($img_path);
          return redirect()->route('clubCoaches')->with('success', 'Coach has been Deleted');
      }else{
          return redirect()->route('clubCoaches')->with('error', 'Something Went Wrong');
      }
  }
  
  public function clubEvents($type){
    $clubid = Auth::guard('clubManager')->user()->id;
    if($type == 'E'){
        $events = Event::orderBy('event_id', 'desc')->where('event_type', '=', $type)->where('event_clubID', '=', $clubid)->get();
        $eventName = 'Event';
        $eventType = 'E';
    }elseif($type == 'N'){
        $events = Event::orderBy('event_id', 'desc')->where('event_type', '=', $type)->where('event_clubID', '=', $clubid)->get();
        $eventName = 'News';
        $eventType = 'N';
    }else{
        $events = Event::orderBy('event_id', 'desc')->where('event_clubID', '=', $clubid)->get();
        $eventName = 'Events/News';
        $eventType = '';
    }
    $data = compact('events', 'eventName', 'eventType');
    return view('myEvents')->with($data);
  }

  public function addClubEvent(Request $request){
    $request->validate([
        'event_title' => 'required',
        'event_description' => 'required',
        'event_type' => 'required',
        'event_image' => 'required',
      ]);

      $imageName = time().".".$request->file('event_image')->extension();
      $request->file('event_image')->move(public_path('Backend/event_images'), $imageName);

      $event = new Event;
      $event->event_title = $request['event_title'];
      $event->event_description = $request['event_description'];
      $event->event_image = $imageName;
      $event->event_type = $request['event_type'];
      $event->event_clubID = Auth::guard('clubManager')->user()->id;
      $event->save();
      if($event){
          return redirect()->back()->with('success', 'Event has been added');
      }else{
          return redirect()->back()->with('error', 'Something Went Wrong');
      }
  }

  public function editClubEvent($id){
    $event = Event::where('event_id', '=', $id)->first();
    if($event->event_type == 'E'){
        $eventName = 'Event';
        $eventType = 'E';
    }elseif($event->event_type == 'N'){
        $eventName = 'News';
        $eventType = 'N';
    }
        $data = compact('event', 'eventName', 'eventType');
        return view('editEvent')->with($data);
  }

  public function updateClubEvent(Request $request, $id){
    $request->validate([
        'event_title' => 'required',
        'event_description' => 'required',
        'event_type' => 'required',
     ]);

     $event = Event::find($id);
     $event->event_title = $request['event_title'];
     $event->event_description = $request['event_description'];
     $event->event_type = $request['event_type'];
     $event->event_status = $request['event_status'];

     if($request['event_image'] != ""){
         $imageName = time().".".$request->file('event_image')->extension();
         $request->file('event_image')->move(public_path('Backend/event_images'), $imageName);
         $event->event_image = $imageName;
     }
     $event->update();
     if($event){
        return redirect('myEvents/'.$request['event_type'])->with('success', 'Event has been update');
    }else{
        return redirect('myEvents/'.$request['event_type'])->with('error', 'Something Went Wrong');
    }
  }

  public function deleteClubEvent($id){
    $event = Event::where('event_id', '=', $id)->first();
    $eventImage = $event->event_image;
    $img_path = public_path("Backend/event_images/".$eventImage);  
    if($event){
        $event->delete();
        File::delete($img_path);
        return redirect()->back()->with('success', 'Deleted Successfully');
    }else{
        return redirect()->back()->with('error', 'Something Went Wrong');
    }
}
  
}
