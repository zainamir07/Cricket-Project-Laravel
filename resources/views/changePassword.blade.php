@extends('layouts.main')

@section('content')

  <div class="container mt-5 pt-3 mb-3">
    <div class="row">
        <h3>Change Password</h3>
    </div>
  </div>

  <div class="container mb-5 pb-5">
    <div class="row">
        <div class="col-md-9 col-lg-9 col-12 m-auto">
            <div class="mb-3">
              <label for="oldPassword" class="form-label">Old Password</label>
              <input type="password"
                class="form-control" name="oldPassword" id="oldPassword" aria-describedby="helpId" placeholder="">
              <small id="helpId" class="form-text text-danger">@error('oldPassword')
                  {{$message}}
              @enderror</small>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password"
                  class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-danger">@error('password')
                    {{$message}}
                @enderror</small>
              </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password"
                  class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="helpId" placeholder="">
                <small id="helpId" class="form-text text-danger">@error('password_confirmation')
                    {{$message}}
                @enderror</small>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-warning">Save Changes</button>
            </div>
        </div>
    </div>
  </div>

@endsection