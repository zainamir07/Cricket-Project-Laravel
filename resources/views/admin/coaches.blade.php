@extends('admin.layout.main')
@section('content')

<div class="container">
    <h2>{{$club->name}} Coaches</h2>
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
                          Add Coach+
                        </button>
                      <button class="btn btn-light refreshBtn">Refresh <i class="fa fa-refresh fetch-users"></i></button>
                    </div>
                 </div>

                 <div class="container mb-5 collapse" id="collapseExample">
                   <form action="{{url('admin/club/coaches')}}/{{$club->id}}" method="post" id="groundForm" enctype="multipart/form-data">
                     @csrf
                  <div class="row">
                    <div class="col-md-4 col-lg-4 col-12 mb-3">
                      <input type="hidden" name="clubID" id="clubID" value="{{$club->id}}">
                      <label for="coach_name" class="form-label">Name</label>
                      <input type="text"
                        class="form-control" name="coach_name" id="coach_name" aria-describedby="helpId" placeholder="">
                      <small id="helpId" class="form-text text-danger">@error('coach_name')
                          {{$message}}
                      @enderror</small>
                    </div>
                        <div class="col-md-4 col-lg-4 col-12 mb-3">
                          <label for="coach_category" class="form-label">Category</label>
                          <select name="coach_category" id="coach_category" class="form-control">
                            <option value="">Select Coach Category</option>
                            @foreach ($category as $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                            @endforeach
                          </select>
                          <small id="helpId" class="form-text text-danger">@error('coach_category')
                              {{$message}}
                          @enderror</small>
                        </div>

                        <div class="col-md-4 col-lg-4 col-12 mb-3">
                          <label for="coach_image" class="form-label">Image</label>
                          <input type="file" name="coach_image" id="coach_image" class="form-control">
                          <small id="helpId" class="form-text text-danger">@error('coach_image')
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
                                <th>Status</th>
                                <th>Actions</th>
                             </tr>
                          </thead>
                          <tbody>
                              @php
                                  $i = 1;
                              @endphp
                              @foreach ($coaches as $coach)
                              <tr>
                                  <td>{{$i}}</td>
                                  <td>
                                    <span class="ground_image">
                                      <img src="{{url('Backend/user_images')}}/{{$coach->coach_image}}" alt="" width="100px" class="rounded-circle">
                                    </span>
                                    <p class="mt-2">{{$coach->coach_name}}</p></td>
                                    <td>{{Custom::categoryName($coach->coach_category)}}</td>
                                    <td>{{Custom::status($coach->coach_status)}}</td>
                                 
                                  <td>
                                      <a href="{{url('admin/club/editCoach')}}/{{$coach->coach_id}}" class="btn btn-primary m-1">
                                          <i class="fa fa-edit"></i>
                                      </a>
                                      <a href="{{url('admin/club/deleteCoach')}}/{{$coach->coach_id}}" class="btn btn-danger m-1 deleteBtn"><i class="fa fa-trash"></i></a>
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