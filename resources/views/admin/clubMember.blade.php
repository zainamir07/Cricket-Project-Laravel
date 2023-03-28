@extends('admin.layout.main')
@section('content')

<div class="container">
    <h2>All ( {{$clubName}} ) Members</h2>
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
                          Add Member+
                        </button>
                      <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
                    </div>
                 </div>

                 <div class="container mb-5 collapse" id="collapseExample">
                   <form action="{{url('admin/club/clubMembers/store')}}/{{$club->id}}" method="post" id="groundForm" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                    <input type="hidden" name="clubManager_id" id="clubManager_id" value="{{$club->id}}">
                    <div class="col-md-4 col-lg-4 col-12 mb-3">
                      <label for="club_name" class="form-label">Name</label>
                      <input type="text"
                        class="form-control" name="clubMember_name" id="clubMember_name" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-danger">@error('clubMember_name')
                          {{$message}}
                      @enderror</small>
                    </div>
                        <div class="col-md-4 col-lg-4 col-12 mb-3">
                          <label for="clubMember_email" class="form-label">Email</label>
                          <input type="email"
                            class="form-control" name="clubMember_email" id="clubMember_email" aria-describedby="helpId" placeholder="">
                          <small id="helpId" class="form-text text-danger">@error('clubMember_email')
                              {{$message}}
                          @enderror</small>
                        </div>

                    <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="clubMember_contact" class="form-label">Contact</label>
                        <input type="text"
                          class="form-control" name="clubMember_contact" id="clubMember_contact" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-danger">@error('clubMember_contact')
                            {{$message}}
                        @enderror</small>
                      </div>
                    
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="clubMember_address" class="form-label">Address</label>
                        <input type="text"
                          class="form-control" name="clubMember_address" id="clubMember_address" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-danger">@error('clubMember_address')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="clubMember_image" class="form-label">Image</label>
                        <input type="file" name="clubMember_image" id="clubMember_image" class="form-control">
                        <small id="helpId" class="form-text text-danger">@error('clubMember_image')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="clubMember_category" class="form-label">Category</label>
                        <select name="clubMember_category" id="clubMember_category" class="form-control">
                          <option value="">Select Member Category</option>
                          @foreach ($category as $cate)
                              <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                          @endforeach
                        </select>
                        <small id="helpId" class="form-text text-danger">@error('clubMember_address')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-lg-4 col-md-4 col-12 mb-3">
                        <label for="clubMember_password" class="form-label">Password</label>
                        <input type="password" name="clubMember_password" id="clubMember_password" class="form-control">
                        <small id="helpId" class="form-text text-danger">@error('clubMember_password')
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
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($members as $member)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>
                                    <span class="member_image">
                                      <img src="{{url('Backend/club_images')}}/{{$member->image}}" alt="" width="70px" class="rounded-circle">
                                    </span>
                                    <p class="mt-2">{{$member->name}}</p></td>
                                    <td>{{$member->contact}}</td>
                                  <td>{{$member->address}}</td>
                                  {{-- <td>{{Custom::categoryName($member->user_categoryID)}}</td> --}}
                                  <td>{{Custom::categoryName($member->user_categoryID)}}</td>
                                    <td> @if ($member->status == 'A')
                                        <span class="badge-success badge p-2">Active</span>
                                        @elseif($member->status == 'B')
                                        <span class="badge-danger badge p-2">Block</span>
                                        @elseif($member->status == 'P')
                                        <span class="badge-info badge p-2">Pending</span>
                                    @endif  </td>
                                  <td>
                                      <a href="{{url('admin/club/clubMembers/edit')}}/{{$member->id}}" class="btn btn-primary m-1">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="{{url('admin/club/clubMembers/delete')}}/{{$member->id}}" class="btn btn-danger m-1 deleteBtn"><i class="fa fa-trash"></i></a>
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