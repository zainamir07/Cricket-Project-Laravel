@extends('admin.layout.main')
@section('content')

<div class="container">
    <h2>All grounds</h2>
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
                          Add Ground+
                        </button>
                      <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
                    </div>
                 </div>

                 <div class="container collapse" id="collapseExample">
                   <form action="{{route('admin_add_new_ground')}}" method="post" id="groundForm" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                    <div class="col-md-4 col-lg-4 col-12 mb-3">
                      <label for="ground_name" class="form-label">Name</label>
                      <input type="text"
                        class="form-control" name="ground_name" id="ground_name" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-muted">@error('ground_name')
                          {{$message}}
                      @enderror</small>
                    </div>

                    
                    <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="ground_city" class="form-label">City</label>
                       <select name="ground_city" id="ground_city" class="form-control">
                        <option value="">Select The City</option>
                        @foreach ($cities as $city)
                            <option value="{{$city->id}}">{{$city->city}}</option>
                        @endforeach
                       </select>
                        <small id="helpId" class="form-text text-muted">@error('ground_city')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="ground_address" class="form-label">Address</label>
                        <input type="text"
                          class="form-control" name="ground_address" id="ground_address" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">@error('ground_address')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="ground_perDay" class="form-label">Price Per Day</label>
                        <input type="text"
                          class="form-control" name="ground_perDay" id="ground_perDay" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">@error('ground_perWeek')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="ground_perWeek" class="form-label">Price Per Week</label>
                        <input type="text"
                          class="form-control" name="ground_perWeek" id="ground_perWeek" aria-describedby="helpId" placeholder="">
                        <small id="helpId" class="form-text text-muted">@error('ground_perWeek')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-md-4 col-lg-4 col-12 mb-3">
                        <label for="image" class="form-label">Ground Image</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <small id="helpId" class="form-text text-muted">@error('image')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-lg-12 col-12 mb-3">
                        <label for="ground_description" class="form-label">Description</label>
                        <textarea name="ground_description" id="ground_description" cols="30" rows="3" class="form-control"></textarea>
                        <small id="helpId" class="form-text text-muted">@error('ground_image')
                            {{$message}}
                        @enderror</small>
                      </div>
                      <div class="col-12 col-lg-4 mb-3">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                      </div>
                    </div>
                  </div>
              
                 <div class="table_section padding_infor_info">
                    <div class="table-responsive-sm">
                       <table class="table">
                          <thead>
                             <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>City</th>
                                <th>Address</th>
                                <th>Fee</th>
                                <th>Status</th>
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($grounds as $ground)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>
                                    <span class="ground_image">
                                      <img src="{{url('Backend/ground_images')}}/{{$ground->ground_image}}" alt="" width="100px" class="rounded-circle">
                                    </span>
                                    <p class="mt-2">{{$ground->ground_name}}</p></td>
                                  <td>{{$ground->ground_cityID}}</td>
                                  <td>{{$ground->ground_address}}</td>
                                  <td><p>PerDay: {{$ground->ground_perDayFee}}</p>
                                    <p>PerWeek: {{$ground->ground_perWeekFee}}</p></td>
                                    <td>
                                        <div class="switch_box box_1">
                                            <input type="checkbox" class="switch_1 ground_status" {{$ground->ground_status == true ? 'checked' : "" }} data-id="{{$ground->ground_id}}">
                                        </div>
                                    </td>
                                  <td>
                                      <a href="{{url('admin/ground/editGround')}}/{{$ground->ground_id}}" class="btn btn-primary m-1">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="{{url('admin/ground/delete')}}/{{$ground->ground_id}}" class="btn btn-danger m-1 deleteBtn"><i class="fa fa-trash"></i></a>
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