@extends('admin.layout.main')

@section('content')

  <div class="container">
    <h2>Edit ({{$memberName}}) details</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Odio, deserunt.</p>
  </div>

  <div class="container">
      <form action="{{url('admin/club/clubMembers/update')}}/{{$member->id}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="clubMember_name" class="form-label">Name</label>
                <input type="text"
                  class="form-control" name="clubMember_name" id="clubMember_name" aria-describedby="helpId" placeholder="" value="{{$member->name}}">
                <small id="helpId" class="form-text text-danger">@error('clubMember_name')
                    {{$message}}
                @enderror</small>
              </div>
        </div> 
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="clubMember_email" class="form-label">Email</label>
                <input type="email"
                  class="form-control" name="clubMember_email" id="clubMember_email" aria-describedby="helpId" placeholder="" value="{{$member->email}}">
                <small id="helpId" class="form-text text-danger">@error('clubMember_email')
                    {{$message}}
                @enderror</small>
              </div>
        </div>  
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="clubMember_address" class="form-label">Address</label>
                <input type="text"
                  class="form-control" name="clubMember_address" id="clubMember_address" aria-describedby="helpId" placeholder="" value="{{$member->address}}">
                <small id="helpId" class="form-text text-danger">@error('clubMember_address')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="mb-3">
                <label for="clubMember_contact" class="form-label">Contact</label>
                <input type="text"
                  class="form-control" name="clubMember_contact" id="clubMember_contact" aria-describedby="helpId" placeholder="" value="{{$member->contact}}">
                <small id="helpId" class="form-text text-danger">@error('clubMember_contact')
                    {{$message}}
                @enderror</small>
              </div>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
            <div class="row mb-3">
                <div class="col-md-9">
                    <label for="clubMember_image" class="form-label">Image</label>
                    <input type="file" name="clubMember_image" id="clubMember_image" class="form-control">
                </div>
                <div class="col-md-3">
                  <img src="{{url('Backend/club_images').'/'.$member->image}}" alt="" width="80px">
                </div>
            </div>
                <small id="helpId" class="form-text text-danger">@error('club_image')
                    {{$message}}
                @enderror</small>
        </div>
        <div class="col-md-6 col-lg-6 col-12">
          <div class="mb-3">
              <label for="clubMember_status" class="form-label">Status</label>
             <select name="clubMember_status" id="clubMember_status" class="form-control">
              <option value="">Select Club Status</option>
              <option value="A" @if ($member->status == 'A') selected @endif>Active</option>
              <option value="B" @if ($member->status == 'B') selected @endif>Block</option>
              <option value="P" @if ($member->status == 'P') selected @endif>Pending</option>
             </select>
              <small id="helpId" class="form-text text-danger">@error('club_contact')
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