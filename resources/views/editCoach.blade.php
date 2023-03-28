@extends('layouts.main')

@section('content')

  <div class="container mt-5 pt-3">
    <h2>Edit Coach</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, deserunt.</p>
  </div>

  <div class="container mb-5 pb-5">
      <form action="{{url('coach/update')}}/{{$coach->coach_id}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="coach_name" class="form-label">Coach Name</label>
                <input type="text"
                  class="form-control" name="coach_name" id="coach_name" aria-describedby="helpId" placeholder="" value="{{$coach->coach_name}}">
                <small id="helpId" class="form-text text-danger">@error('coach_name')
                    {{$message}}
                @enderror</small>
              </div>
        </div> 
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="coach_category" class="form-label">Category</label>
                <select name="coach_category" id="coach_category" class="form-control">
                    <option value="">Select Coach category</option>
                    @foreach ($category as $cate)
                    <option value="{{$cate->category_id}}" @if ($coach->coach_category == $cate->category_id) selected @endif>{{$cate->category_name}}</option>
                    @endforeach
                </select>
                <small id="helpId" class="form-text text-danger">@error('coach_category')
                    {{$message}}
                @enderror</small>
              </div>
        </div>  
        <div class="col-md-12 col-lg-12 col-12">
            <div class="row">
                <div class="col-md-9 col-lg-9 col-12 mb-3">
                <label for="coach_image" class="form-label">Image</label>
                <input type="file" name="coach_image" id="coach_image" class="form-control">
            </div>
                <div class="col-md-3 col-lg-3 col-12 mb-3">
                <img src="{{url('Backend/user_images')}}/{{$coach->coach_image}}" class="img-fluid rounded" alt="" width="100px">
                </div>
                <small id="helpId" class="form-text text-danger">@error('coach_image')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
          <div class="mb-3">
              <label for="coach_status" class="form-label">Status</label>
             <select name="coach_status" id="coach_status" class="form-control">
              <option value="">Select Team Status</option>
              <option value="A" @if ($coach->coach_status == 'A') selected @endif>Active</option>
              <option value="B" @if ($coach->coach_status == 'B') selected @endif>Block</option>
              <option value="P" @if ($coach->coach_status == 'P') selected @endif>Pending</option>
             </select>
              <small id="helpId" class="form-text text-danger">@error('coach_status')
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