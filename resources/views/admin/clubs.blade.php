@extends('admin.layout.main')
@section('content')

<div class="container">
    <h2>All Clubs</h2>
    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Eum recusandae nisi asperiores repellendus!</p>
</div>

<div class="container">
    <div class="row">
        {{-- <div class="row"> --}}
            <!-- table section -->
            <div class="col-md-12 mb-5">
              <div class="white_shd full margin_bottom_30">
                 <div class="full graph_head">
                  <div id="success_msg"></div>
                  @if (session()->has('error'))
                  <div class="alert alert-danger">{{session()->get('error')}}</div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
                @endif
                <div id="edit_errList"></div>
                    <div class="heading1 margin_0 d-flex justify-content-between mt-3 mb-4">
                      <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                          Add Club+
                        </button>
                      <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
                    </div>
                 </div>

                 <div class="container mb-5 collapse" id="collapseExample">
                   <form action="{{route('admin_add_new_club')}}" method="post" id="groundForm" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                    <div class="col-md-4 col-lg-4 col-12 mb-3">
                      <label for="club_name" class="form-label">Name</label>
                      <input type="text"
                        class="form-control" name="club_name" id="club_name" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-danger">@error('club_name')
                          {{$message}}
                      @enderror</small>
                    </div>
                        <div class="col-md-4 col-lg-4 col-12 mb-3">
                          <label for="club_email" class="form-label">Email</label>
                          <input type="email"
                            class="form-control" name="club_email" id="club_email" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-danger">@error('club_email')
                              {{$message}}
                          @enderror</small>
                        </div>

                    <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="club_contact" class="form-label">Contact</label>
                        <input type="text"
                          class="form-control" name="club_contact" id="club_contact" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-danger">@error('club_contact')
                            {{$message}}
                        @enderror</small>
                      </div>
                    
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="club_address" class="form-label">Address</label>
                        <input type="text"
                          class="form-control" name="club_address" id="club_address" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-danger">@error('club_address')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="club_image" class="form-label">Image</label>
                        <input type="file" name="club_image" id="club_image" class="form-control">
                        <small id="helpId" class="form-text text-danger">@error('club_image')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-lg-4 col-md-4 col-12 mb-3">
                        <label for="club_password" class="form-label">Password</label>
                        <input type="password" name="club_password" id="club_password" class="form-control">
                        <small id="helpId" class="form-text text-danger">@error('club_password')
                            {{$message}}
                        @enderror</small>
                      </div>
                     
                      <div class="col-12 col-lg-4 mb-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary">Register</button>
                      </div>
                    </div>
                   </form>
                  </div>
              
                 <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                       <table class="table">
                          <thead>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Members</th>
                                <th>Status</th>
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($clubs as $club)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>
                                    <span class="ground_image">
                                      <img src="{{url('Backend/club_images')}}/{{$club->image}}" alt="" width="100px" class="rounded-circle">
                                    </span>
                                    <p class="mt-2">{{$club->name}}</p></td>
                                    <td>{{$club->contact}}</td>
                                  <td>{{$club->address}}</td>
                                  <td>
                                    <a href="{{url('admin/club/clubMembers')}}/{{$club->id}}" class="btn btn-sm btn-primary mb-2">Members</a> 
                                    <a href="{{url('admin/club/teams')}}/{{$club->id}}" class="btn btn-sm btn-secondary mb-2">Teams</a><br>
                                    <a href="{{url('admin/club/coaches')}}/{{$club->id}}" class="btn btn-sm btn-success mb-2">Coaches</a> </td>
                                    <td> @if ($club->status == 'A')
                                        <span class="badge-success badge p-2">Active</span>
                                        @elseif($club->status == 'B')
                                        <span class="badge-danger badge p-2">Block</span>
                                        @elseif($club->status == 'P')
                                        <span class="badge-info badge p-2">Pending</span>
                                    @endif  </td>
                                  <td>
                                      <a href="{{url('admin/club/editClub')}}/{{$club->id}}" class="btn btn-primary m-1">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="{{url('admin/club/delete')}}/{{$club->id}}" class="btn btn-danger m-1 deleteBtn"><i class="fa fa-trash"></i></a>
                                  </td>
                              </tr>
                              @php
                                   $i++;
                              @endphp
                              @endforeach
                                
                          </tbody>
                       </table>
                       {{-- {{ $grounds->links('pagination::bootstrap-5') }}  --}}
                    </div>
                 </div>
              </div>
           {{-- </div> --}}
      
    </div>
</div>



@endsection