@extends('admin.layout.main')
@section('content')

<div class="container">
    <h2>All ({{$teamName}}) Members</h2>
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
                          Add Team Member+
                        </button>
                      <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
                    </div>
                 </div>

                 <div class="container mb-5 collapse" id="collapseExample">
                   <form action="{{route('admin_add_new_teamMember')}}" method="post" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                    <input type="hidden" name="clubId" id="clubId" value="{{$club->id}}">
                    <input type="hidden" name="teamId" id="teamId" value="{{$team->team_id}}">
                    <div class="col-md-6 col-lg-6 col-12 mb-3"> 
                      <label for="team_playerCategory" class="form-label">Player Category</label>
                      <select name="team_playerCategory" id="team_playerCategory" class="form-control team_playerCategory">
                       <option value="">Select Player Category</option>
                       @foreach ($category as $cate)
                           <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                       @endforeach
                      </select>
                      <small id="helpId" class="form-text text-danger">@error('team_playerCategory')
                          {{$message}}
                      @enderror</small>
                    </div>

                    <div class="col-md-6 col-lg-6 col-12 mb-3">
                        <label for="team_clubMembers" class="form-label">Club Members</label>
                       <select name="team_clubMembers" id="team_clubMembers" class="form-control">
                        <option value="">Select Club Members</option>
                       </select>
                        <small id="helpId" class="form-text text-danger">@error('team_clubMembers')
                            {{$message}}
                        @enderror</small>
                      </div>
                    
                      <div class="col-12 col-lg-4 mb-3 d-flex align-items-center">
                        <button type="submit" class="btn btn-primary">Add Member+</button>
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
                                {{-- <th>Category</th> --}}
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($teamPlayers as $player)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>{{Custom::userName($player->team_player_memberID)}}</td>
                                  <td>{{Custom::playerCategoryName($player->team_player_memberID)}}</td>
                                  <td>
                                      <a href="{{url('admin/club/teamMember/delete')}}/{{$player->team_player_id}}" class="btn btn-danger m-1 deleteBtn"><i class="fa fa-trash"></i></a>
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