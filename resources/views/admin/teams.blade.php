@extends('admin.layout.main')
@section('content')

<div class="container">
    <h2>All ({{$club->name}}) Teams</h2>
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
                          Add Team+
                        </button>
                      <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
                    </div>
                 </div>

                 <div class="container mb-5 collapse" id="collapseExample">
                   <form action="{{route('admin_add_new_team')}}" method="post" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                    <input type="hidden" name="club_id" id="club_id" value="{{$club->id}}">
                    <div class="col-md-6 col-lg-6 col-12 mb-3">
                      <label for="clubTeam_name" class="form-label">Team Name</label>
                      <input type="text"
                        class="form-control" name="clubTeam_name" id="clubTeam_name" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-danger">@error('clubTeam_name')
                          {{$message}}
                      @enderror</small>
                    </div>

                    <div class="col-md-6 col-lg-6 col-12 mb-3">
                        <label for="clubTeam_category" class="form-label">Category</label>
                       <select name="clubTeam_category" id="clubTeam_category" class="form-control">
                        <option value="">Select Team category</option>
                        <option value="H">Hard</option>
                        <option value="T">Tenis</option>
                       </select>
                        <small id="helpId" class="form-text text-danger">@error('clubTeam_category')
                            {{$message}}
                        @enderror</small>
                      </div>
                    
                      <div class="col-md-12 col-12 mb-3">
                        <label for="clubTeam_description" class="form-label">Description</label>
                        <textarea name="clubTeam_description" id="clubTeam_description" class="form-control" cols="30" rows="4"></textarea>
                        <small id="helpId" class="form-text text-danger">@error('clubTeam_description')
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
                                <th>Category</th>
                                <th>Members</th>
                                <th>Status</th>
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($teams as $team)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>{{$team->team_name}}</td>
                                    <td> @if ($team->team_category == 'H') Hard @elseif($team->team_category == 'T') Tenis @endif</td>
                                  <td><a href="{{url('admin/club/clubMembers')}}/{{$team->team_id}}/{{$club->id}}" class="btn btn-sm btn-primary mb-2">Members</a></td>
                                    <td> @if ($team->team_status == 'A')
                                        <span class="badge-success badge p-2">Active</span>
                                        @elseif($team->team_status == 'B')
                                        <span class="badge-danger badge p-2">Block</span>
                                        @elseif($team->team_status == 'P')
                                        <span class="badge-info badge p-2">Pending</span>
                                    @endif  </td>
                                  <td>
                                      <a href="{{url('admin/club/editTeam')}}/{{$team->team_id}}" class="btn btn-primary m-1">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="{{url('admin/club/team/delete')}}/{{$team->team_id}}" class="btn btn-danger m-1 deleteBtn"><i class="fa fa-trash"></i></a>
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