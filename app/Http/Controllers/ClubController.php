<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\ClubManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClubController extends Controller
{
    public function index(){
        $clubs = ClubManager::orderBy('id', 'desc')->get();
        $data = compact('clubs');
        return view('admin.clubs')->with($data);
    }

    public function store(Request $request){
        $request->validate([
            'club_name' => 'required',
            'club_email' => 'required',
            'club_address' => 'required',
            'club_contact' => 'required',
            'club_image' => 'required',
            'club_password' => 'required',
        ]);
            $imageName = time().".".$request->file('club_image')->extension();
            $request->file('club_image')->move(public_path('Backend/club_images'), $imageName);
     
            $club = new ClubManager;
            $club->name = $request['club_name'];
            $club->email = $request['club_email'];
            $club->address = $request['club_address'];
            $club->contact = $request['club_contact'];
            $club->password = md5($request['club_password']);
            $club->image = $imageName;
            // echo '<pre>';
            // print_r($club->toArray());
            // die;
            $club->save();
            if($club){
                return redirect()->route('admin.clubs')->with('success', 'Club has been added');
            }else{
                return redirect()->route('admin.clubs')->with('error', 'Something Went Wrong');
            }
        }

        public function edit($id){
            $club = ClubManager::find($id);
            $data = compact('club');
            return view('admin.editClub')->with($data);
     }

     public function update($id, Request $request){
        $request->validate([
            'club_name' => 'required',
            'club_email' => 'required',
            'club_address' => 'required',
            'club_contact' => 'required',
        ]);
            $club = ClubManager::find($id);
            $club->name = $request['club_name'];
            $club->email = $request['club_email'];
            $club->contact = $request['club_contact'];
            $club->address = $request['club_address'];
            $club->status = $request['club_status'];
            if($request['club_image'] != ""){
                $imageName = time().".".$request->file('club_image')->extension();
                $request->file('club_image')->move(public_path('Backend/club_images'), $imageName);
                $club->image = $imageName;
            }else{
                $club->image = $club->image;
            }
            // echo '<pre>';
            // print_r($club->toArray());
            // die;
            $club->update();
            if($club){
                return redirect()->route('admin.clubs')->with('success', 'Club has been Updated');
            }else{
                return redirect()->route('admin_edit_club')->with('error', 'Something Went Wrong');
            }
    }

    public function ground_status_check(Request $request){
        $id = $request['id'];
        $status = $request['status'];
       $club = ClubManager::where('id', '=', $id)->first();
       $club->status = $status;
       $club->update();
       if($club){
        return response()->json(['success'=> 'Status Updated']);
       }else{
        return response()->json(['errors'=> 'Something Went Wrong']);
       }

    }




}
