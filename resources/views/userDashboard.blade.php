@extends('layouts.main')
@section('content')
    
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12 si-box-padding">
                    <section class="common-head-wrapper-sm clearfix">
                        <div class="wrapper-head mt-4 mb-4">
                            <h4><i class="glyphicon glyphicon-th-large"></i><span>Dashboard</span></h4>
                        </div>

                    </section>
                    <!-- end of common-head-wrapper-sm -->
                </div>
                <!-- end of si-box-padding -->
            </div>
            <!-- end of row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- ================================
                     widget box main
                     ================================-->
                    <!-- <section class="dash-main-widget-box"> -->
                    <div class="row top-boxes">
                        <div class="col-sm-3 ">
                            <div class=" text-center border p-2 pb-0">
                                <h2>{{$totalMatches}}
                                </h2>
                                <p>Total Matches <br></p>
                                <div class="control-in-dc above-box">
                                </div>
                            </div>
                            <!-- end of dash-box -->
                        </div>

                        <div class="col-sm-3 ">
                            <div class=" text-center border p-2 pb-0">
                                <h2 class="">0 </h2>
                                <p>Pending Match Request <br></p>
                                <div class="control-in-dc above-box">
                                </div>
                            </div>
                            <!-- end of dash-box -->
                        </div>

                        <div class="col-sm-3 ">
                            <div class=" text-center border p-2 pb-0">
                                <h2 class="">0</h2>
                                <p>Winning Matches</p>
                                <div class="control-in-dc above-box">
                                </div>
                            </div>
                            <!-- end of dash-box -->
                        </div>

                        <div class="col-sm-3 ">
                            <div class=" text-center border p-2 pb-0">
                                <h2 class="">{{$totalTeams}}</h2>
                                <p>Total Teams <br></p>
                                <div class="control-in-dc above-box">
                                </div>
                            </div>
                            <!-- end of dash-box -->
                        </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <h3 class="mb-4"> Match details</h3>
            <table id="table" class="table table-striped">
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    {{-- <tr>
                        @php $srNo = 1;    @endphp
                        @foreach ($matches as $match)
                            
                        <td>{{$srNo}}</td>
                        <td>{{Custom::clubName($match->match_request_byClubID)}}
                             <br> {{Custom::teamName($match->matchRequestByTeamID)}}
                            </td>
                        <td>Vs</td>
                        <td>{{Custom::clubName($match->match_request_againstClubID)}} 
                            <br> @if ($match->matchRequestAgainstTeamID != "") {{Custom::teamName($match->matchRequestAgainstTeamID)}} @else 'N/A'  @endif 
                        </td>
                        <td style="max-width:100px;">@if ($match->match_request_winningTeam != "") {{Custom::teamName($match->match_request_winningTeam)}} win by {{$match->match_request_winByRuns}} Runs and {{$match->match_request_winByWickets}} Wickets. @else 'N/A'  @endif</td>
                        <td><a href="{{url('matchDetails')}}/{{$match->match_request_id}}" class="btn btn-sm btn-warning text-dark">View Details</a></td>
                    </tr>
                        @php $srNo++;  @endphp
                        @endforeach --}}
                   
                    {{-- <div class="alert alert-info">No Details Found</div> --}}
                </tbody>
            </table>
        </div>
        </div>

        <div class="container">
            <div class="table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <h3 class="mb-4">My Teams</h3>
                                    </tr>
                                    
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Team Name</th>
                                        <th>Club Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $srNo = 1; @endphp
                                    @foreach ($teams as $team)
                                    <tr>
                                        <td>{{$srNo;}}</td>
                                        <td>{{$team->team_name}}</td>
                                        <td>{{Custom::clubName($team->team_clubID)}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
        @endsection
