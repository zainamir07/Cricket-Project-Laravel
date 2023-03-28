<?php

namespace App\Http\Controllers;

use App\Models\ClubManager;
use App\Models\Coach;
use App\Models\PlayerCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CoachController extends Controller
{
    
    public function index($clubid){
        $coaches = Coach::where('coach_clubID', '=', $clubid)->get();
        $category = PlayerCategory::all();
        $club = ClubManager::where('id', '=', $clubid)->first();
        $data = compact('coaches', 'category', 'club');
        return view('admin.coaches')->with($data);
    }

    public function store(Request $request){
      $request->validate([
        'coach_name' => 'required',
        'coach_category' => 'required',
        'coach_image' => 'required',
        'clubID' => 'required',
      ]);

      $imageName = time().".".$request->file('coach_image')->extension();
      $request->file('coach_image')->move(public_path('Backend/user_images'), $imageName);

      $coach = new Coach;
      $coach->coach_name = $request['coach_name'];
      $coach->coach_category = $request['coach_category'];
      $coach->coach_image = $imageName;
      $coach->coach_clubID = $request['clubID'];
      $coach->save();
      if($coach){
          return redirect()->back()->with('success', 'Coach has been added');
      }else{
          return redirect()->back()->with('error', 'Something Went Wrong');
      }
    }

    public function edit($coachid){
      $coach = Coach::where('coach_id', '=', $coachid)->first();
      $coachClub = $coach->coach_clubID;
      $category = PlayerCategory::all();
      $data = compact('coach', 'category', 'coachClub');
      return view('admin.editCoach')->with($data);
    }

    public function update($id, Request $request){
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
          // echo '<pre>';
          // print_r($coach->toArray());
          // die;
          $coach->update();
          if($coach){
              return redirect()->back()->with('success', 'Coach has been Updated');
          }else{
              return redirect()->back()->with('error', 'Something Went Wrong');
          }
  }

  public function delete($id){
    $coach = Coach::where('coach_id', '=', $id)->first();
    $coachImage = $coach->coach_image;
    $img_path = public_path("Backend/user_images/".$coachImage);  
    if($coach){
        $coach->delete();
        File::delete($img_path);
        return redirect()->back()->with('success', 'Coach has been Deleted');
    }else{
        return redirect()->back()->with('error', 'Something Went Wrong');
    }
}


}
