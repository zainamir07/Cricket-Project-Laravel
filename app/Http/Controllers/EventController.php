<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index(){
        $events = Event::orderBy('event_id', 'desc')->where('event_type', '=', 'E')->get();;
        $data = compact('events');
        return view('admin.events')->with($data);
    }

    public function store(Request $request){
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
        $event->event_clubID = Auth::id();
        $event->save();
        if($event){
            return redirect()->back()->with('success', 'Event has been added');
        }else{
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
      }

      public function edit($id){
        $event = Event::where('event_id', '=', $id)->first();
        $data = compact('event');
        return view('admin.editEvent')->with($data);
      }

      public function update(Request $request, $id){
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
            return redirect()->route('admin.events')->with('success', 'Event has been added');
        }else{
            return redirect()->route('admin.events')->with('error', 'Something Went Wrong');
        }
      }

      public function news(){
        $news = Event::orderBy('event_id', 'desc')->where('event_type', '=', 'N')->get();
        $data = compact('news');
        return view('admin.news')->with($data);
      }

      public function delete($id){
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
