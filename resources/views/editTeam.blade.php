@extends('layouts.main')

@section('content')

  <div class="container mt-5 pb-2">
    <h2>Edit ({{$team->team_name}}) details</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, deserunt.</p>
  </div>

  <div class="container mb-5 pb-5">
      <form action="{{url('team/update')}}/{{$team->team_id}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="team_name" class="form-label">Team Name</label>
                <input type="text"
                  class="form-control" name="team_name" id="team_name" aria-describedby="helpId" placeholder="" value="{{$team->team_name}}">
                <small id="helpId" class="form-text text-danger">@error('team_name')
                    {{$message}}
                @enderror</small>
              </div>
        </div> 
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="team_category" class="form-label">Category</label>
                <select name="team_category" id="team_category" class="form-control">
                    <option value="">Select team category</option>
                    <option value="H" @if ($team->team_category == 'H') selected @endif>Hard</option>
                    <option value="T" @if ($team->team_category == 'T') selected @endif>Tenis</option>
                </select>
                <small id="helpId" class="form-text text-danger">@error('team_category')
                    {{$message}}
                @enderror</small>
              </div>
        </div>  
        <div class="col-md-12 col-lg-12 col-12">
            <div class="mb-3">
                <label for="team_description" class="form-label">Description</label>
                <textarea name="team_description" id="team_description" class="form-control" cols="30" rows="10">{{$team->team_description}}</textarea>
                <small id="helpId" class="form-text text-danger">@error('team_description')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
          <div class="mb-3">
              <label for="team_status" class="form-label">Status</label>
             <select name="team_status" id="team_status" class="form-control">
              <option value="">Select Team Status</option>
              <option value="A" @if ($team->team_status == 'A') selected @endif>Active</option>
              <option value="B" @if ($team->team_status == 'B') selected @endif>Block</option>
             </select>
              <small id="helpId" class="form-text text-danger">@error('team_status')
                  {{$message}}
              @enderror</small>
            </div>
      </div>
        </div>
            <div class="mb-5">
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
  </div>

@endsection