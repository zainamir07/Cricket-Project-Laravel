@extends('layouts.main')
@section('content')
    
  <main>
    <div class="container mt-5 text-center">
       <h2>Club Login</h2>
       <p>Not have an account. <a href="">Register here</a></p>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7 col-lg-7 col-12 m-auto">
               @if (session()->has('error'))
                   <div class="alert alert-info">{{session()->get('error')}}</div>
               @endif
                <form action="{{route('club.login')}}" method="post">
                    @csrf
                <!-- Email input -->
                    <div class="form-outline mb-4">
                      <input type="email" id="form2Example1" name="email" class="form-control" />
                      <label class="form-label" for="form2Example1">Email address</label>
                      <span class="text-danger">@error('email')
                          {{$message}}
                      @enderror</span>
                    </div>
                  
                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" id="form2Example2" name="password" class="form-control" />
                      <label class="form-label" for="form2Example2">Password</label>
                      <span class="text-danger">@error('email')
                        {{$message}}
                    @enderror</span>
                    </div>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>
                </form>
                  

            </div>
        </div>
    </div>
    
  </main>

@endsection
