<?php

namespace App\Http\Controllers;

use App\Models\ClubManager;
use App\Models\PlayerCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ClubMemberController extends Controller
{
    public function index($id){
        $members = User::where('role', '=', 'U')->where('user_clubManagerID', '=', $id)->get();
        $club = ClubManager::where('id', '=', $id)->first();
        $clubName = $club->name;
        $category = PlayerCategory::all();
        $data = compact('members', 'clubName', 'club', 'category');
        return view('admin.clubMember')->with($data);
    }
    
    public function store(Request $request){
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
            // echo '<pre>';
            // print_r($club->toArray());
            // die;
            $club->save();
            if($club){
                return redirect()->back()->with('success', 'Club Member has been added');
            }else{
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
        }

        public function edit($id){
            $member = User::find($id);
            $memberName = $member->name;
            $data = compact('member', 'memberName');
            return view('admin.editClubMember')->with($data);
     }

     public function update($id, Request $request){
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
                return redirect()->back()->with('success', 'Club Member has been Updated');
            }else{
                return redirect()->back()->with('error', 'Something Went Wrong');
            }
    }

            public function delete($id){
                $member = User::where('id', '=', $id)->first();
                $memberImage = $member->ground_image;
                $img_path = public_path("Backend/club_images/".$memberImage);  
                if($member){
                    $member->delete();
                    File::delete($img_path);
                    return redirect()->back()->with('success', 'Club Member has been Deleted');
                }else{
                    return redirect()->back()->with('error', 'Something Went Wrong');
                }
            }

}
