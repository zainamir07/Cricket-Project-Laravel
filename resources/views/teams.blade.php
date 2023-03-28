@extends('layouts.main')
@section('content')
    
            <div class="container">
               <div class="row">
                  <div class="col-md-12 si-box-padding">
                     <section class="common-head-wrapper-sm clearfix">
                        <div class="wrapper-head mt-4 mb-4">
                           <h4 class="bg-dark text-white p-3 d-block"><i class="glyphicon glyphicon-th-large"></i><span>My Teams</span>
                            <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Add New Team+
                              </button>
                           </h4>
                        </div>
                       
                     </section>
                     <!-- end of common-head-wrapper-sm -->
                  </div>
                  <!-- end of si-box-padding -->
               </div>
               @if (session()->has('error'))
               <div class="alert alert-danger">{{session()->get('error')}}</div>
             @endif
             @if (session()->has('success'))
             <div class="alert alert-success">{{session()->get('success')}}</div>
             @endif
               <div class="container mb-5 collapse" id="collapseExample">
                <h3>Add Member</h3>
                <form action="{{route('addClubTeam')}}" method="post" id="groundForm" enctype="multipart/form-data">
                  @csrf
               <div class="row mt-2">
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
           

               <!-- end of row -->
               <div class="row">
                  <div class="col-md-12">
                     <div class="table-responsive">
                        <table id="table" class="table table-striped">
                           <thead>
                              <tr>
                                <th>Srno</th>
                                <th>Team Name</th>
                                <th>Category</th>
                                <th>Members</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                               @php $srNo = 1;  @endphp
                            @foreach ($teams as $team)
                                    <tr>
                                        <td>{{$srNo}}</td>
                                        <td>{{$team->team_name}}</td>
                                        <td> @if ($team->team_category == 'H') Hard @elseif($team->team_category == 'T') Tenis @endif</td>
                                      <td><a href="{{url('club/teamMembers')}}/{{$team->team_id}}/{{$club->id}}" class="btn btn-sm btn-primary text-white mb-2">Members</a></td>
                                        <td> @if ($team->team_status == 'A')
                                            <span class="badge-success bg-success badge p-2">Active</span>
                                            @elseif($team->team_status == 'B')
                                            <span class="badge-danger bg-danger badge p-2">Block</span>
                                            @elseif($team->team_status == 'P')
                                            <span class="badge-info bg-info badge p-2">Pending</span>
                                        @endif  </td>
                                      <td>
                                          <a href="{{url('team/edit/')}}/{{$team->team_id}}" class="btn btn-primary btn-sm text-white m-1">
                                              <i class="fa fa-edit"></i>
                                          </a>
                                          <a href="{{url('team/delete')}}/{{$team->team_id}}" class="btn btn-danger btn-sm text-white m-1 "><i class="fa fa-trash"></i></a>
                                      </td>
                                          </tr>
                                          @php  $srNo++;  @endphp
                                    @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>    
               </div>   
            </div> 
            @endsection
