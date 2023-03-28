@extends('admin.layout.main')

@section('content')

  <div class="container">
    <h2>Edit Ground details</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, deserunt.</p>
  </div>

  <div class="container">
      <form action="{{url('admin/ground/updateGround')}}/{{$ground->ground_id}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="ground_name" class="form-label">Name</label>
                <input type="text"
                  class="form-control" name="ground_name" id="ground_name" aria-describedby="helpId" placeholder="" value="{{$ground->ground_name}}">
                <small id="helpId" class="form-text text-muted">@error('ground_name')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="ground_city" class="form-label">City</label>
                <select name="ground_city" id="ground_city" class="form-control">
                    <option value="">Select The City</option>
                    @foreach ($cities as $city)
                        <option value="{{$city->id}}" @if ($ground->ground_cityID == $city->id)
                            selected
                        @endif>{{$city->city}}</option>
                    @endforeach
                </select>
                <small id="helpId" class="form-text text-muted">@error('ground_city')
                    {{$message}}
                @enderror</small>
              </div>
        </div>    
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="ground_address" class="form-label">Address</label>
                <input type="text"
                  class="form-control" name="ground_address" id="ground_address" aria-describedby="helpId" placeholder="" value="{{$ground->ground_address}}">
                <small id="helpId" class="form-text text-muted">@error('ground_address')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="ground_perDay" class="form-label">Fees Per Day</label>
                <input type="text"
                  class="form-control" name="ground_perDay" id="ground_perDay" aria-describedby="helpId" placeholder="" value="{{$ground->ground_perDayFee}}">
                <small id="helpId" class="form-text text-muted">@error('ground_perDay')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="ground_perWeek" class="form-label">Fees Per Week</label>
                <input type="text"
                  class="form-control" name="ground_perWeek" id="ground_perWeek" aria-describedby="helpId" placeholder="" value="{{$ground->ground_perWeekFee}}">
                <small id="helpId" class="form-text text-muted">@error('ground_perWeek')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="row mb-3">
                <div class="col-md-9">
                    <label for="ground_image" class="form-label">Image</label>
                    <input type="file" name="ground_image" id="ground_image" class="form-control">
                </div>
                <div class="col-md-3">
                  <img src="{{url('Backend/ground_images').'/'.$ground->ground_image}}" alt="" width="80px">
                </div>
            </div>
                <small id="helpId" class="form-text text-muted">@error('ground_image')
                    {{$message}}
                @enderror</small>
        </div>
        <div class="col-lg-12 col-md-12 col-12">
          <div class="mb-3">
            <label for="ground_description" class="form-label"></label>
            <textarea class="form-control" name="ground_description" id="ground_description" rows="3">{{$ground->ground_description}}</textarea>
          </div>

          {{-- <label for="ground_description" class="form-label">Description</label>
          <textarea class="from-control" name="ground_description" id="ground_description" cols="30" rows="10" >{{$ground->ground_description}}</textarea> --}}
        </div>
            </div>
            <div class="mb-5">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
  </div>

@endsection