<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Ground;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

use function GuzzleHttp\Promise\all;

class GroundController extends Controller
{

    public function index(){
        $grounds = Ground::all();
        $cities = Cities::all();
        $data = compact('grounds', 'cities');
        return view('admin.grounds')->with($data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'ground_name' => 'required',
            'ground_address' => 'required',
            'ground_city' => 'required',
            'image' => 'required',
            'ground_description' => 'required',
            'ground_perDay' => 'required',
            'ground_perWeek' => 'required',
        ]);
    
        if($validator->fails()){
            return response()->json(['errors'=> $validator->messages()]);
        }else{

            $imageName = time().".".$request->file('image')->extension();
            $request->file('image')->move(public_path('Backend/ground_images'), $imageName);
     
            $ground = new Ground();
            $ground->ground_name = $request['ground_name'];
            $ground->ground_cityId = $request['ground_city'];
            $ground->ground_address = $request['ground_address'];
            $ground->ground_perDayFee = $request['ground_perDay'];
            $ground->ground_perWeekFee = $request['ground_perWeek'];
            $ground->ground_description = $request['ground_description'];
            $ground->ground_image = $imageName;
            // echo '<pre>';
            // print_r($ground->toArray());
            // die;
            $ground->save();
            if($ground){
                return redirect()->route('admin.grounds')->with('success', 'Ground has been added');
            }else{
                return redirect()->route('admin.grounds')->with('error', 'Something Went Wrong');
            }
    
        }
    }

    
    public function edit($id){
        $ground = Ground::find($id);
        $cities = Cities::all();
        $data = compact('ground', 'cities');
        return view('admin.editGround')->with($data);
 }

    public function update($id, Request $request){
        $request->validate([
            'ground_name' => 'required',
            'ground_address' => 'required',
            'ground_city' => 'required',
            'ground_description' => 'required',
            'ground_perDay' => 'required',
            'ground_perWeek' => 'required',
        ]);
            $ground = Ground::find($id);
            $ground->ground_name = $request['ground_name'];
            $ground->ground_cityId = $request['ground_city'];
            $ground->ground_address = $request['ground_address'];
            $ground->ground_perDayFee = $request['ground_perDay'];
            $ground->ground_perWeekFee = $request['ground_perWeek'];
            $ground->ground_description = $request['ground_description'];
            if($request['ground_image'] != ""){
                $imageName = time().".".$request->file('ground_image')->extension();
                $request->file('ground_image')->move(public_path('Backend/ground_images'), $imageName);
                $ground->ground_image = $imageName;
            }else{
                $ground->ground_image = $ground->ground_image;
            }
            // echo '<pre>';
            // print_r($ground->toArray());
            // die;
            $ground->update();
            if($ground){
                return redirect()->route('admin.grounds')->with('success', 'Ground has been Updated');
            }else{
                return redirect()->route('admin_edit_ground')->with('error', 'Something Went Wrong');
            }
    }

    public function ground_status_check(Request $request){
        $id = $request['id'];
        $status = $request['status'];
       $ground = Ground::where('ground_id', '=', $id)->first();
       $ground->ground_status = $status;
       $ground->update();
       if($ground){
        return response()->json(['success'=> 'Status Updated']);
       }else{
        return response()->json(['errors'=> 'Something Went Wrong']);
       }

    }


    public function delete($id){
        $ground = Ground::where('ground_id', '=', $id)->first();
        $groundImage = $ground->ground_image;
        $img_path = public_path("Backend/ground_images/".$groundImage);  
        if($ground){
            $ground->delete();
            File::delete($img_path);
            return redirect()->route('admin.grounds')->with('success', 'Ground has been Deleted');
        }else{
            return redirect()->route('admin.grounds')->with('error', 'Something Went Wrong');
        }
    }


}
