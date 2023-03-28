@extends('layouts.main')
@section('content')

<div class="container mt-5 pb-2">
    <h2>Edit Profile</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, deserunt.</p>
  </div>

  <div class="container mb-5 pb-5">
      <form action="{{url('profile/update')}}/{{$club->id}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="club_name" class="form-label">Club Name</label>
                <input type="text"
                  class="form-control" name="club_name" id="club_name" aria-describedby="helpId" placeholder="" value="{{$club->name}}">
                <small id="helpId" class="form-text text-danger">@error('club_name')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="club_email" class="form-label">Email</label>
                <input type="email"
                  class="form-control" name="club_email" id="club_email" aria-describedby="helpId" placeholder="" value="{{$club->email}}">
                <small id="helpId" class="form-text text-danger">@error('club_email')
                    {{$message}}
                @enderror</small>
              </div>
        </div> 
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="club_contact" class="form-label">Contact</label>
                <input type="text"
                  class="form-control" name="club_contact" id="club_contact" aria-describedby="helpId" placeholder="" value="{{$club->contact}}">
                <small id="helpId" class="form-text text-danger">@error('club_contact')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="club_address" class="form-label">Address</label>
                <input type="text"
                  class="form-control" name="club_address" id="club_address" aria-describedby="helpId" placeholder="" value="{{$club->address}}">
                <small id="helpId" class="form-text text-danger">@error('club_address')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-12 col-lg-12 col-12">
            <div class="row">
                <div class="col-md-10 col-lg-10 col-12">
                    <div class="mb-3">
                        <label for="club_image" class="form-label">Image</label>
                        <input type="file" name="club_image" id="club_image" class="form-control">
                        <small id="helpId" class="form-text text-danger">@error('club_image')
                            {{$message}}
                        @enderror</small>
                      </div>
                </div>
                <div class="col-md-2 col-lg-2 col-12">
                        <img src="{{url('Backend/club_images')}}/{{$club->image}}" class="img-fluid" alt="">
                </div>
            </div>
            
        </div> 

        </div>
            <div class="mb-5">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
  </div>

@endsection