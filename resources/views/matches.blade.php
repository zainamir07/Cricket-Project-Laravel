@extends('layouts.main')

@section('content')

<div class="container mb-4">
    <div class="row">
        <div class="col-md-12 si-box-padding">
            <section class="common-head-wrapper-sm clearfix">
                <div class="wrapper-head mt-4 mb-4">
                    <h4 class="bg-dark text-white p-3 d-block"><i
                            class="glyphicon glyphicon-th-large"></i><span>Match Requests Send</span>
                        {{-- <a href="matchRequest.php" class="btn btn-sm btn-warning pull-right">Send New Match Request</a> --}}
                        <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            Send New Match Request
                          </button>
                    </h4>
                </div>

                <div class="container collapse" id="collapseExample">
                    <form action="{{route('sendNewMatchRequest')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-lg-6 col-mb-6 mb-2">
                                <div class="form-outline">
                                    <label class="form-label" for="matchRequestTitle">Title</label>
                                    <input type="text" id="matchRequestTitle" name="matchRequestTitle"
                                        value="" class="form-control"
                                        placeholder="Enter Match Request Title" />
                                </div>
                                <span class="text-danger">@error('matchRequestTitle')
                                    {{$message}}
                                @enderror</span>
                            </div>

                            <div class="col-lg-6 col-mb-6 mb-2">
                                <div class="form-outline">
                                    <label class="form-label" for="matchRequestAgainstClub">All Clubs</label>
                                    <select class="form-control" name="matchRequestAgainstClub">
                                        <option value="">View All Clubs</option>
                                        @foreach ($clubs as $club)
                                            <option value="{{$club->id}}">{{$club->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('matchRequestAgainstClub')
                                    {{$message}}
                                @enderror</span>
                            </div>
                        </div>


                        <div class="row mb-2 mb-2">

                            <div class="col-md-4">
                                <div class="form-outline">
                                    <label class="form-label" for="matchRequestCategory">Category</label>
                                    <select class="form-control" name="matchRequestCategory" id="matchRequestCategory"
                                        onchange="">
                                        <option value="">Select Match Type</option>
                                        <option value="H">Hard</option>
                                        <option value="T">Tenis</option>
                                    </select>
                                    <span class="text-danger">@error('matchRequestCategory')
                                        {{$message}}
                                    @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-outline">
                                    <label class="form-label" for="matchRequesTeam">My Teams</label>
                                    <select class="form-control" name="matchRequesTeam" id="matchRequesTeam">
                                        <option value="">Choose Your Teams</option>
                                        @foreach ($myTeams as $myTeam)
                                        <option value="{{$myTeam->team_id}}">{{$myTeam->team_name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('matchRequesTeam')
                                        {{$message}}
                                    @enderror</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <label class="form-label" for="matchRequestOvers">Overs</label>
                                <select class="form-control" name="matchRequestOvers">
                                    <option value="">Select Match Overs</option>
                                    <option value="SS">Super Six</option>
                                    <option value="T20">T-20 </option>
                                    <option value="1D">1 Day </option>
                                    <option value="T">Test </option>
                                </select>
                                <span class="text-danger">@error('matchRequestOvers')
                                    {{$message}}
                                @enderror</span>
                            </div>

                            <div class="row mb-2">
                                <div class="col-mb-12 mb-2">
                                    <div class="form-outline">
                                        <label for="matchRequestDescription">Description</label>
                                        <textarea name="matchRequestDescription" class="form-control"
                                            id="matchRequestDescription" cols="30"
                                            rows="10"></textarea>
                                            <span class="text-danger">@error('matchRequestDescription')
                                                {{$message}}
                                            @enderror</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-warning btn-block mb-4">Send Request</button>
                    </form>
                </div>
            </section>
            <!-- end of common-head-wrapper-sm -->
        </div>
        <!-- end of si-box-padding -->
    </div>
    <!-- end of row -->
    <div class="row">
        <div class="col-md-12">
            @if (session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
          @endif
          @if (session()->has('success'))
          <div class="alert alert-success">{{session()->get('success')}}</div>
          @endif
            <div class="table-responsive">
                <table id="table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Srno</th>
                            <th>Title</th>
                            <th>Against</th>
                            <th>My Team</th>
                            <th>Type</th>
                            <th>Format</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                        @php $srNo = 1;  @endphp
                        @foreach ($requestSend as $request)
                        <tr>
                            <td>{{$srNo}}</td>
                            <td>{{$request->match_request_title}}</td>
                            <td>{{Custom::clubName($request->match_request_againstClubID)}}</td>
                            <td>{{Custom::teamName($request->matchRequestByTeamID)}}</td>
                            <td> @if ($request->match_request_category == 'H') Hard  @elseif($request->match_request_category == 'T') Tenis @endif </td>
                            <td>{{$request->match_request_overs}}</td>
                            <td>{{$request->created_at}}</td>
                            <td>{{Custom::status($request->match_request_status)}}</td>
                            <td><a href="{{url('matchDetails')}}/{{$request->match_request_id}}" class="btn btn-sm btn-info">Details</a></td>
                        </tr>
                        @php  $srNo++;  @endphp
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-12 si-box-padding">
            <section class="common-head-wrapper-sm clearfix">
                <div class="wrapper-head mt-4 mb-4">
                    <h4 class="bg-dark text-white p-3 d-block"><i
                            class="glyphicon glyphicon-th-large"></i><span>Match Requests Recieve</span>
                    </h4>
                </div>

            </section>
            <!-- end of common-head-wrapper-sm -->
        </div>
        <!-- end of si-box-padding -->
    </div>
    <!-- end of row -->
    <div class="row">
        <div class="col-md-12">
            
            <div class="table-responsive">
                <table id="table2" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Srno</th>
                            <th>Title</th>
                            <th>Against Club</th>
                            <th>Against Team</th>
                            <th>Type</th>
                            <th>Format</th>
                            <th>Request Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        @php $srNo = 1;  @endphp
                        @foreach ($requestRecieve as $request)
                        <tr>
                            <td>{{$srNo}}</td>
                            <td>{{$request->match_request_title}}</td>
                            <td>{{Custom::clubName($request->match_request_againstClubID)}}</td>
                            <td>{{Custom::teamName($request->matchRequestByTeamID)}}</td>
                            <td> @if ($request->match_request_category == 'H') Hard  @elseif($request->match_request_category == 'T') Tenis @endif </td>
                            <td>{{$request->match_request_overs}}</td>
                            <td>{{$request->created_at}}</td>
                            <td>{{Custom::status($request->match_request_status)}}</td>
                            <td><a href="{{url('matchDetails')}}/{{$request->match_request_id}}" class="btn btn-sm btn-info">Details</a></td>
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