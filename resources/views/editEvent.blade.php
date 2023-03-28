@extends('layouts.main')

@section('content')

  <div class="container mt-5 pt-3">
    <h2>Edit {{$eventName}} details</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, deserunt.</p>
  </div>

  <div class="container mb-5 pb-5">
      <form action="{{url('myEvents/updateEvent')}}/{{$event->event_id}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-12 col-lg-12 col-12">
            <div class="mb-3">
                <label for="event_title" class="form-label">{{$eventName}} Title</label>
                <input type="text"
                  class="form-control" name="event_title" id="event_title" aria-describedby="helpId" placeholder="" value="{{$event->event_title}}">
                <small id="helpId" class="form-text text-danger">@error('event_title')
                    {{$message}}
                @enderror</small>
              </div>
        </div> 
        <div class="col-md-12 col-lg-12 col-12">
            <div class="mb-3">
                <label for="event_description" class="form-label">{{$eventName}} Description</label>
                <textarea name="event_description" id="event_description" class="form-control" cols="30" rows="10">{{$event->event_description}}</textarea>
                <small id="helpId" class="form-text text-danger">@error('event_description')
                    {{$message}}
                @enderror</small>
              </div>
        </div>  
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="event_type" class="form-label">{{$eventName}} Type</label>
                <select name="event_type" id="event_type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="E" @if ($event->event_type == 'E') selected @endif>Event</option>
                    <option value="N" @if ($event->event_type == 'N') selected @endif >News</option>
                </select>
                <small id="helpId" class="form-text text-danger">@error('event_type')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="event_status" class="form-label">{{$eventName}} Status</label>
                <select name="event_status" id="event_status" class="form-control">
                    <option value="">Select Status</option>
                    <option value="A" @if ($event->event_status == 'A') selected @endif>Active</option>
                    <option value="P" @if ($event->event_status == 'P') selected @endif >Pending</option>
                    <option value="B" @if ($event->event_status == 'B') selected @endif >Block</option>
                </select>
                <small id="helpId" class="form-text text-danger">@error('event_status')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-12 col-lg-12 col-12 mb-3">
            <div class="row mb-3">
                <div class="col-md-9">
                    <label for="event_image" class="form-label">{{$eventName}} Image</label>
                    <input type="file" name="event_image" id="event_image" class="form-control">
                </div>
                <div class="col-md-3">
                  <img src="{{url('Backend/event_images').'/'.$event->event_image}}" alt="" width="80px">
                </div> 
            </div>
                <small id="helpId" class="form-text text-danger">@error('event_image')
                    {{$message}}
                @enderror</small>
        </div>

        </div>
            <div class="mb-5">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
  </div>

@endsection