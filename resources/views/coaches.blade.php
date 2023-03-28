@extends('layouts.main')
@section('content')
<section class="mb-4">
    <div class="container">
       <div class="row">
          <div class="col-md-12 si-box-padding">
             <section class="common-head-wrapper-sm clearfix">
                <div class="wrapper-head mt-4 mb-4">
                   <h4 class="bg-dark text-white p-3 d-block"><i class="glyphicon glyphicon-th-large"></i><span>All Coaches</span>
                    <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Add New Coach+
                      </button>
                   </h4>
                </div>
               
             </section>
             <!-- end of common-head-wrapper-sm -->
          </div>
          <!-- end of si-box-padding -->
       </div>
       <!-- end of row -->
       <div class="container mb-5 collapse" id="collapseExample">
        <form action="{{route('addClubCoach')}}" method="post" id="groundForm" enctype="multipart/form-data">
          @csrf
       <div class="row">
         <div class="col-md-4 col-lg-4 col-12 mb-3">
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

       <div class="row">
          <div class="col-md-12">
            <div id="success_msg"></div>
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
                        <th>Name/Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Action</th>
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
                        <img src="{{url('Backend/user_images')}}/{{$coach->coach_image}}" alt="" width="70px" class="rounded-circle">
                      </span>
                      <p class="mt-2">{{$coach->coach_name}}</p></td>
                      <td>{{Custom::categoryName($coach->coach_category)}}</td>
                      <td>{{Custom::status($coach->coach_status)}}</td>
                   
                    <td>
                        <a href="{{url('coach/edit')}}/{{$coach->coach_id}}" class="btn btn-primary m-1 text-white btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{url('coach/delete')}}/{{$coach->coach_id}}" class="btn btn-danger m-1 text-white btn-sm"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @php
                     $i++;
                @endphp
                @endforeach
                       
                   </tbody>
                </table>
             </div>
          </div>    
       </div>   
    </div> 
 </section>
           


@endsection