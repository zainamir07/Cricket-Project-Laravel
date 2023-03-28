@extends('admin.layout.main')
@section('content')

<section class="mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 si-box-padding border">
                @if (session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
              @endif
              @if (session()->has('success'))
              <div class="alert alert-success">{{session()->get('success')}}</div>
              @endif
                <section class="common-head-wrapper-sm clearfix">
                    <div class="wrapper-head mt-4 mb-4">
                        <h4 class="bg-dark text-white p-3 d-block"><i class="glyphicon glyphicon-th-large"></i><span>View Match Details</span>                                
                    </h4>

                    </div>
                    <div class="container-fluid ">
                        <div class="row">
                            <style>
                            .list-group li:nth-child(even) {
                                background-color: #F8F9FA;
                            }
                            </style>
                            <div class="col-lg-4 col-12 col-md-4 ">
                                <h5 class="mt-2 mb-3">Match Requested Sender Details</h5>
                                <ul class="list-group ">
                                    <li class="list-group-item">Club Name:<span class="fw-bold pull-right  ">
                                            {{Custom::clubName($matchDetails->match_request_byClubID)}}</span></li>
                                    <li class="list-group-item ">Team Name:<span class="fw-bold pull-right">
                                            {{Custom::teamName($matchDetails->matchRequestByTeamID)}}</span></li>
                                    <li class="list-group-item">Match Category:<span class="fw-bold pull-right">
                                        @if ($matchDetails->match_request_category == 'H') Hard  @elseif($matchDetails->match_request_category == 'T') Tenis @endif </span></li>
                                    <li class="list-group-item">Match Overs:<span class="fw-bold pull-right">
                                            {{$matchDetails->match_request_overs}}</span></li>
                                    <li class="list-group-item">Request Date<span class="fw-bold pull-right">
                                            {{$matchDetails->created_at}}</span></li>
                                    <li class="list-group-item">Request Status:<span class="fw-bold pull-right">
                                            {{Custom::status($matchDetails->match_request_status)}}</span></li>
                                </ul>
                            </div>

                            <div class="col-lg-4 col-12 col-md-4">
                                <h5 class="mt-2 mb-3">Match Request Reciever Details</h5>
                                <!-- <h5 class="mt-2 mb-3">Request Against Clud Details</h5> -->
                                <ul class="list-group">
                                    <li class="list-group-item">Club Name:<span class="fw-bold pull-right  ">
                                        {{Custom::clubName($matchDetails->match_request_againstClubID)}}</span></li>
                                    <li class="list-group-item ">Team Name:<span class="fw-bold pull-right">
                                       @if ($matchDetails->matchRequestAgainstTeamID != "")
                                       {{ Custom::teamName($matchDetails->matchRequestAgainstTeamID)}}
                                       @else
                                       'N/A'
                                       @endif  </span></li>
                                    <li class="list-group-item">Match Category:<span class="fw-bold pull-right">
                                        @if ($matchDetails->match_request_category == 'H') Hard  @elseif($matchDetails->match_request_category == 'T') Tenis @endif </span></li>
                                    <li class="list-group-item">Match Overs:<span class="fw-bold pull-right">
                                            {{$matchDetails->match_request_overs}}</span></li>
                                    <li class="list-group-item">Request Date<span class="fw-bold pull-right">
                                            {{$matchDetails->created_at}}</span></li>
                                    <li class="list-group-item">Request Status:<span class="fw-bold pull-right">
                                            {{Custom::status($matchDetails->match_request_status)}}</span></li>
            
                                </ul>
                            </div>

                            <div class="col-lg-4 col-12 mb-4 col-md-4">
                                <h5 class="mt-2 mb-3">Ground Details</h5>
                                <ul class="list-group">
                                    @if ($ground != '')
                                    <li class="list-group-item ">Ground Name:<span class="fw-bold pull-right">
                                           {{$ground->ground_name}}</span></li>
                                    <li class="list-group-item ">Ground Address:<span class="fw-bold pull-right">
                                            {{$ground->ground_address}}</span></li>
                                    <li class="list-group-item ">Ground Per Day Fees:<span
                                            class="fw-bold pull-right"> {{$ground->ground_perDayFee}}</span></li>
                                    <li class="list-group-item ">Ground Per Week Fees:<span
                                            class="fw-bold pull-right"> {{$ground->ground_perWeekFee}}</span></li>
                                    <li class="list-group-item bg-primary text-white">Final Date:<span
                                            class="fw-bold float-end">
                                            {{$matchDetails->match_request_dayDate}}</span></li>
                                    <li class="list-group-item bg-success text-white">Final Time:<span
                                            class="fw-bold float-end">
                                           {{$matchDetails->match_request_dayTime}}</span></li>
                                    @else
                                    <li class="list-group-item "><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                            Set Ground Details
                                          </button></li>
                                    @endif
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                        <hr class="mt-3">

                            @if ($matchDetails->match_request_winningTeam != "")
                            <div class="container mt-5 rounded shadow mb-4 bg-primary  p-2 text-center text-white">
                                <h5>{{Custom::teamName($matchDetails->match_request_winningTeam)}} win by {{$matchDetails->match_request_winByRuns}} runs and {{$matchDetails->match_request_winByWickets}} Wickets</h5>
                            </div>
                            @else
                            <div class="container mb-4 mt-5 text-center">
                                <!-- <button class="btn btn-primary">Who Win</button> -->
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
                                    Who Win
                                  </button>
                            </div>
                            @endif
                </div>
                @if ($matchDetails->match_request_winningTeam != "")
                <div class="container mb-4 mt-5 text-center">
                    <!-- <button class="btn btn-primary">Who Win</button> -->
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
                        Update Win Details
                      </button>
                </div>
                @endif

                <div class="container mt-5 border">
                    <!-- end of row -->
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                        <div class="table-responsive">
                                <h4 class="mb-4 mt-2">Players of 
                                    @if ($matchDetails->matchRequestByTeamID)
                                        {{Custom::teamName($matchDetails->matchRequestByTeamID)}}
                                    @else
                                        'N/a'
                                    @endif
                                </h4>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Srno</th>
                                            <th>Name</th>
                                            <th>Categroy</th>
                                            {{-- @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_byClubID)
                                            <th>Action</th>
                                            @endif --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $srNo = 1;  @endphp
                                        @foreach ($senderPlayers as $player)
                                        <tr>
                                            <td>{{$srNo;}}</td>
                                            <td>{{Custom::userName($player->team_player_memberID)}}</td>
                                            <td>{{Custom::playerCategoryName($player->team_player_memberID)}}</td>
                                            {{-- @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_byClubID)
                                                <td><button class="btn btn-warning">Performance+</button></td>
                                            @endif --}}
                                        </tr>
                                        @php $srNo++; @endphp
                                        @endforeach
                                    </tbody>
                                </tr>
                                               
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6">
                    <div class="table-responsive">
                                @if ($matchDetails->matchRequestAgainstTeamID)
                                <h4 class="mb-4 mt-2">Players of  {{Custom::teamName($matchDetails->matchRequestAgainstTeamID)}}
                            </h4>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Srno</th>
                                        <th>Name</th>
                                        <th>Categroy</th>
                                        {{-- @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_againstClubID)
                                        <th>Action</th> --}}
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $srNo = 1;  @endphp
                                    @foreach ($receiverPlayers as $player)
                                    <tr>
                                        <td>{{$srNo;}}</td>
                                        <td>{{Custom::userName($player->team_player_memberID)}}</td>
                                        <td>{{Custom::playerCategoryName($player->team_player_memberID)}}</td>
                                        {{-- @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_againstClubID)
                                        <td><button class="btn btn-warning">Performance+</button></td>
                                        @endif --}}
                                    </tr>
                                    @php $srNo++; @endphp
                                    @endforeach
                                </tbody>
                            </tr>
                                           
                        </tbody>
                    </table>
                </div>
            </div>

     
       </div>
                   
                
            <!-- <a href="requestReject.php" class="btn btn-danger ms-2 pull-right">Reject</a>
                                <a href="requestApprove.php" class="btn btn-primary ms-2 pull-right">Approve</a> -->

</section>

 <!-- Add ground Modal -->

 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            {{-- <div class="container-fluid"> --}}
                <form action="{{url('admin/matchGroundUpdate')}}/{{$matchDetails->match_request_id}}" method="post">
                    @csrf
                    <div class="col-md-12 mb-2">
                        <label class="" for="groundName">Select Ground
                            Name</label>
                        <select name="groundID" class="form-control" id="groundName" required>
                           <option value="">Select Ground</option>
                           @foreach ($allGrounds as $ground)
                               <option value="{{$ground->ground_id}}">{{$ground->ground_name}}</option>
                           @endforeach
                        </select>

                        <label for="setdatetime">Set Date</label>
                        <input type="date" name="setDate" id="setdatetime" class="form-control" required>

                        <label for="setdatetime">Set Time</label>
                        <input type="datetime" name="setTime" id="setdatetime" class="form-control" required>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="approverequestbtn" class="btn btn-primary">Approve & Schelude</button>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>

  
 <!-- Add Winning Team Details Modal -->

 <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin/matchWinningAnnounce')}}/{{$matchDetails->match_request_id}}" method="post">
                    @csrf
                <div class="col-md-12 mb-2">
                    <label class="" for="winTeamID">Select Winning Team
                        Name</label>
                    <select name="winTeamID" class="form-control" id="winTeamID" required>
                        {{-- <option value="{{$matchDetails->matchRequestByTeamID}}">{{Custom::teamName($matchDetails->matchRequestByTeamID)}}</option> --}}
                        <option value="">Selected Winning Team</option>
                        <option value="{{$matchDetails->matchRequestAgainstTeamID}}" @if ($matchDetails->match_request_winningTeam == $matchDetails->matchRequestAgainstTeamID)
                            selected
                        @endif  >{{Custom::teamName($matchDetails->matchRequestAgainstTeamID)}}</option>

                        <option value="{{$matchDetails->matchRequestByTeamID}}" @if ($matchDetails->match_request_winningTeam == $matchDetails->matchRequestByTeamID)
                            selected 
                        @endif  >{{Custom::teamName($matchDetails->matchRequestByTeamID)}}</option>

                    </select>
                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label for="winByRuns">Win By Runs:</label>
                            <input type="text" class="form-control" name="winByRuns" value="<?php echo $matchDetails->match_request_winByRuns; ?>">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label for="winByWickets">And Win By Wickets:</label>
                            <input type="text" name="winByWickets" class="form-control" value="<?php echo $matchDetails->match_request_winByWickets; ?>"> 
                        </div>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" name="WinTeam" class="btn btn-primary">Announce</button>
        </div>
        </form>
        </div>
      </div>
    </div>
  </div>


   
@endsection