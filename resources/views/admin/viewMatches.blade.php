@extends('admin.layout.main')
@section('content')


<div class="container">
    <h2>All Matches</h2>
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
                 </div>

                
                 <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                       <table class="table">
                          <thead>
                             <tr>
                                <th>Request #</th>
                                <th>Sender</th>
                                <th>Reciever</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($matches as $match)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>{{Custom::clubName($match->match_request_byClubID)}}</td>
                                    <td> {{Custom::clubName($match->match_request_againstClubID)}}</td>
                                  <td>@if ($match->match_request_category == 'H') Hard  @elseif($match->match_request_category == 'T') Tenis @endif</td>
                                    <td> {{Custom::status($match->match_request_status)}}</td>
                                  <td>
                                      <a href="{{url('admin/matchDetails')}}/{{$match->match_request_id}}" class="btn btn-sm btn-primary">View details</a>
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