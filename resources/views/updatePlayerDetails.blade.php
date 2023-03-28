@extends('layouts.main')
@section('content')

<section class="mb-4">
    <div class="container">
        <div class="row">
            <div class="col-md-12 si-box-padding">
                <section class="common-head-wrapper-sm clearfix">
                    <div class="wrapper-head mt-4 mb-4">
                        <h4 class="bg-dark text-white p-3 d-block"><i
                                class="glyphicon glyphicon-th-large"></i><span>Update Player Details</span>
                            <!-- <a href="viewAllMembers.php" class="btn btn-sm btn-warning pull-right" >View All Members</a> -->
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
                @if (session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
              @endif
              @if (session()->has('success'))
              <div class="alert alert-success">{{session()->get('success')}}</div>
              @endif
                <form action="{{url('updatePlayerDetails')}}/{{$playerid}}/{{$matchid}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-2">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="totalOvers">Total Overs</label>
                                <input type="text" id="totalOvers" name="totalOvers" class="form-control"
                                    placeholder="Enter Total Overs" value="{{$playerDetails->match_detail_player_overs}}" />
                                    <span class="text-danger">@error('totalOvers')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="scoreInOvers">Total Score in Overs</label>
                                <input type="text" id="scoreInOvers" name="scoreInOvers" class="form-control"
                                    placeholder="How many score" value="{{$playerDetails->match_detail_player_overs_score}}" />
                                    <span class="text-danger">@error('scoreInOvers')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="totalWickets">Total Wickets</label>
                                <input type="text" id="totalWickets" name="totalWickets" class="form-control"
                                    placeholder="Enter the total Wickets" value="{{$playerDetails->match_detail_player_wickets}}" />
                                    <span class="text-danger">@error('totalWickets')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        

                        
                    </div>


                    <div class="row mb-2">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="playerStatus">Player Status</label>
                                <select class="form-control" id="playerStatus" name="playerStatus">
                                    <option value="">Select Player Status</option>
                                    <option <?php if($playerDetails->match_detail_player_out_status == "O"){echo "selected";} ?> value="O">Out</option>
                                    <option <?php if($playerDetails->match_detail_player_out_status == "NO"){echo "selected";} ?> value="NO">Not Out</option>
                                    <option <?php if($playerDetails->match_detail_player_out_status == "NP"){echo "selected";} ?> value="NP">Not Played</option>
                                    <span class="text-danger">@error('playerStatus')
                                        {{$message}}
                                    @enderror</span>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                            <label class="form-label" for="ballsPlayed">Total Balls Played</label>
                                <input type="text" id="ballsPlayed" name="ballsPlayed" class="form-control"
                                    placeholder="How many balls Played?" value="{{$playerDetails->match_detail_player_balls}}" />
                                    <span class="text-danger">@error('ballsPlayed')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="scoreInBatting">Total Score in Batting</label>
                                <input type="text" id="scoreInBatting" name="scoreInBatting" class="form-control"
                                    placeholder="How many score they create? " value="{{$playerDetails->match_detail_player_score}}" />
                                    <span class="text-danger">@error('scoreInBatting')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>

                        

                        
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="playerPosition">Player Position</label>
                                <!-- <input type="text" id="playerPosition" name="playerPosition" class="form-control"
                                    placeholder="Enter the player position" value="" /> -->
                                    <select name="playerPosition" id="playerPosition" class="form-control">
                                        <option value="">Select Player Position</option>
                                        <option value="1" @if ($playerDetails->match_detail_player_position == '1') selected  @endif >1</option>
                                        <option value="2" @if ($playerDetails->match_detail_player_position == '2') selected  @endif >2</option>
                                        <option value="3" @if ($playerDetails->match_detail_player_position == '3') selected  @endif >3</option>
                                        <option value="4" @if ($playerDetails->match_detail_player_position == '4') selected  @endif >4</option>
                                        <option value="5" @if ($playerDetails->match_detail_player_position == '5') selected  @endif >5</option>
                                        <option value="6" @if ($playerDetails->match_detail_player_position == '6') selected  @endif >6</option>
                                        <option value="7" @if ($playerDetails->match_detail_player_position == '7') selected  @endif >7</option>
                                        <option value="8" @if ($playerDetails->match_detail_player_position == '8') selected  @endif >8</option>
                                        <option value="9" @if ($playerDetails->match_detail_player_position == '9') selected  @endif >9</option>
                                        <option value="10" @if ($playerDetails->match_detail_player_position == '10') selected  @endif >10</option>
                                        <span class="text-danger">@error('playerPosition')
                                            {{$message}}
                                        @enderror</span>
                                    </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="winningAwards">Winning Awards</label>
                                <select id="" class="form-control" name="winningAwards">
                                    <option value="">Select Awards</option>
                                    <option <?php if($playerDetails->match_detail_player_award == "MOM"){echo 'selected';} ?> value="MOM">Man Of The Match</option>
                                    <option <?php if($playerDetails->match_detail_player_award == "SOM"){echo 'selected';} ?> value="SOM">Short Of The Match</option>
                                    <option <?php if($playerDetails->match_detail_player_award == "COM"){echo 'selected';} ?> value="COM">Catch Of The Match</option>
                                    <span class="text-danger">@error('winningAwards')
                                        {{$message}}
                                    @enderror</span>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 col-lg-4">
                            <div class="form-outline">
                                <label class="form-label" for="winningAwardDesc">Winning Award Details</label>
                                <input type="text" id="winningAwardDesc" name="winningAwardDesc" class="form-control"
                                    placeholder="Enter the player winning Awards" value="{{$playerDetails->match_detail_player_award_desc}}" />
                                    <span class="text-danger">@error('winningAwardDesc')
                                        {{$message}}
                                    @enderror</span>
                            </div>
                        </div>
                    </div>



                    <!-- Submit button -->
                    <button type="submit" class="btn btn-warning btn-block mb-4">Update
                        Details</button>
                </form>
            </div>
        </div>
    </div>
</section>


@endsection