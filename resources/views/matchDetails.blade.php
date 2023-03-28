@extends('layouts.main')
@section('content')

<section class="mb-4">
    <div class="container">
        <div class="row border mt-4 mb-2 pb-4 rounded shadow">
            <div class="col-md-12 si-box-padding">
                @if (session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
              @endif
              @if (session()->has('success'))
              <div class="alert alert-success">{{session()->get('success')}}</div>
              @endif
                <section class="common-head-wrapper-sm clearfix">
                    <div class="wrapper-head mt-4 mb-4">
                        <h4 class="bg-dark text-white p-3 d-block"><i class="glyphicon glyphicon-th-large"></i><span>View Match Details</span>
            
                        @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_againstClubID)
                        @if ($matchDetails->match_request_status == 'P')

                        <a href="requestReject.php" class="btn btn-sm btn-danger ms-2 pull-right">Reject</a>
                        <a href="#myModal" data-toggle="modal"
                            class="btn btn-sm btn-primary ms-2 pull-right">Approve</a>

                        @elseif($matchDetails->match_request_status == 'R')    
                        <a href="javascript:;" class="btn btn-sm btn-danger ms-2 pull-right">Rejected by Me</a>

                        @elseif($matchDetails->match_request_status == 'A')    
                        <a href="javascript:;" class="btn btn-sm btn-success ms-2 pull-right">Challenge Accepted</a>

                        @elseif($matchDetails->match_request_status == 'S')
                        <a href="javascript:;" class="btn btn-sm btn-success ms-2 pull-right">Match Scheduled</a>
                        @endif  

                        @endif  
                                
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
                                <h5 class="mt-2 mb-3">Request Reciever Club Details</h5>
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
                                <h5 class="mb-0 pb-0">Ground Details</h5>
                                <p class="mb-0 mt-0">Set By Admin</p>
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
                                    <li class="list-group-item ">N/A</li>
                                    @endif
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
                           
                </div>

                    @if ($matchDetails->match_request_winningTeam != "")
                    <div class="container mt-5 rounded shadow mb-4 bg-info  p-2 text-center">
                        <h5>{{Custom::teamName($matchDetails->match_request_winningTeam)}} win by {{$matchDetails->match_request_winByRuns}} runs and {{$matchDetails->match_request_winByWickets}} Wickets</h5>
                    </div>
                    @endif
                {{-- <div > --}}
                    <!-- end of row -->
                    <div class="row mt-5 shadow">
                        <div class="col-lg-6 col-md-6 border rounded">
                        <div class="table-responsive">
                                <h4 class="mb-4">Players of 
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
                                            @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_byClubID)
                                            <th>Performance</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $srNo = 1;  @endphp
                                        @foreach ($senderPlayers as $player)
                                        <tr>
                                            <td>{{$srNo;}}</td>
                                            <td>{{Custom::userName($player->team_player_memberID)}}</td>
                                            <td>{{Custom::playerCategoryName($player->team_player_memberID)}}</td>
                                            @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_byClubID)
                                                <td>
                                                    @if ($matchDetails->match_request_winningTeam == "")
                                                    <i class="fa fa-info"></i>
                                                        @else
                                                    @if (Custom::playerExist($player->team_player_memberID, $matchDetails->match_request_id) == true)
                                                    <a href="{{url('editPlayerDetails')}}/{{$player->team_player_memberID}}/{{$matchDetails->match_request_id}}" class="btn btn-primary text-white">Edit+</a>
                                                    @else
                                                    <a href="{{url('addPlayerDetails')}}/{{$player->team_player_memberID}}/{{$matchDetails->match_request_id}}" class="btn btn-warning text-white">Add+</a>
                                                    @endif

                                                    @endif
                                                </td>
                                            @endif
                                        </tr>
                                        @php $srNo++; @endphp
                                        @endforeach
                                    </tbody>
                                </tr>
                                               
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 border rounded">
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
                                        @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_againstClubID)
                                        <th>Action</th>
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
                                        @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_againstClubID)
                                        <td>
                                            @if ($matchDetails->match_request_winningTeam == "")
                                            <i class="fa fa-info p-2 border rounded-circle " title="You can add the user performance when admin announce the result"></i>
                                                @else
                                            @if (Custom::playerExist($player->team_player_memberID, $matchDetails->match_request_id) == true)
                                            <a href="{{url('editPlayerDetails')}}/{{$player->team_player_memberID}}/{{$matchDetails->match_request_id}}" class="btn btn-primary text-white">Edit+</a>
                                            @else
                                            <a href="{{url('addPlayerDetails')}}/{{$player->team_player_memberID}}/{{$matchDetails->match_request_id}}" class="btn btn-warning text-white">Add+</a>
                                            @endif
                                        </td>
                                        @endif

                                        @endif
                                    </tr>
                                    @php $srNo++; @endphp
                                    @endforeach
                                </tbody>
                            </tr>
                                           
                        </tbody>
                    </table>
                    @else
                    @if (Auth::guard('clubManager')->user()->id == $matchDetails->match_request_againstClubID)
                    <h4> Select You Team <a href="#myModal" data-toggle="modal"
                        class="btn btn-sm btn-primary ms-2">My Teams</a></h4>
                        @else
                        <h6>Against Club Not Select Their Team</h6>
                    @endif
                @endif
                {{-- </div> --}}
            </div>

     
       </div>
                   
                
            <!-- <a href="requestReject.php" class="btn btn-danger ms-2 pull-right">Reject</a>
                                <a href="requestApprove.php" class="btn btn-primary ms-2 pull-right">Approve</a> -->

</section>



    <!-- Modal For Team selection-->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                    <h4 class="modal-title">Modal Header</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('acceptRequest')}}" method="post">
                                 @csrf
                        <div class="row mb-2 mb-2">

                            <div class="col-md-12">
                                <div class="form-outline">
                                    <label class="form-label" for="matchRequestCategory">Seletc Your Team</label>
                                    <select class="form-control" name="matchRequestAgainstClubTeamID"
                                        id="matchRequestAgainstClubTeamID" required>
                                        <option value="">Select Your Team</option>
                                       @foreach ($receiverTeams as $team)
                                       <option value="{{$team->team_id}}">{{$team->team_name}} </option>
                                       @endforeach
                                    </select>
                                    <input type="hidden" name="requestID" value="{{$matchDetails->match_request_id}}">
                                </div>

                            </div>

                            <div class="col-md-12 mt-2">
                                <div class="form-outline">
                                    <input type="submit" class="btn btn-sm btn-warning pull-right" name="acceptBtn"
                                        value="Accepted">
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection