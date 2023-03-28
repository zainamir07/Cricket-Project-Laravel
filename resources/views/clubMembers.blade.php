@extends('layouts.main')
@section('content')
    
            <div class="container">
               <div class="row">
                  <div class="col-md-12 si-box-padding">
                     <section class="common-head-wrapper-sm clearfix">
                        <div class="wrapper-head mt-4 mb-4">
                           <h4 class="bg-dark text-white p-3 d-block"><i class="glyphicon glyphicon-th-large"></i><span>My Members</span>
                            <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Add New Member+
                              </button>
                           </h4>
                        </div>
                       
                     </section>
                     <!-- end of common-head-wrapper-sm -->
                  </div>
                  <!-- end of si-box-padding -->
               </div>
               @if (session()->has('error'))
               <div class="alert alert-danger">{{session()->get('error')}}</div>
             @endif
             @if (session()->has('success'))
             <div class="alert alert-success">{{session()->get('success')}}</div>
             @endif
               <div class="container mb-5 collapse" id="collapseExample">
                <h3>Add Member</h3>
                <form action="{{route('clubMembers')}}" method="post" id="groundForm" enctype="multipart/form-data">
                  @csrf
               <div class="row mt-2">
                 <input type="hidden" name="clubManager_id" id="clubManager_id" value="{{$club->id}}">
                 <div class="col-md-4 col-lg-4 col-12 mb-3">
                   <label for="club_name" class="form-label">Name</label>
                   <input type="text"
                     class="form-control" name="clubMember_name" id="clubMember_name" aria-describedby="helpId" placeholder="">
                   <small id="helpId" class="form-text text-danger">@error('clubMember_name')
                       {{$message}}
                   @enderror</small>
                 </div>
                     <div class="col-md-4 col-lg-4 col-12 mb-3">
                       <label for="clubMember_email" class="form-label">Email</label>
                       <input type="email"
                         class="form-control" name="clubMember_email" id="clubMember_email" aria-describedby="helpId" placeholder="">
                       <small id="helpId" class="form-text text-danger">@error('clubMember_email')
                           {{$message}}
                       @enderror</small>
                     </div>

                 <div class="col-md-4 col-lg-4 col-12 mb-3">
                     <label for="clubMember_contact" class="form-label">Contact</label>
                     <input type="text"
                       class="form-control" name="clubMember_contact" id="clubMember_contact" aria-describedby="helpId" placeholder="">
                     <small id="helpId" class="form-text text-danger">@error('clubMember_contact')
                         {{$message}}
                     @enderror</small>
                   </div>
                 
                   <div class="col-md-4 col-lg-4 col-12 mb-3">
                     <label for="clubMember_address" class="form-label">Address</label>
                     <input type="text"
                       class="form-control" name="clubMember_address" id="clubMember_address" aria-describedby="helpId" placeholder="">
                     <small id="helpId" class="form-text text-danger">@error('clubMember_address')
                         {{$message}}
                     @enderror</small>
                   </div>
                   <div class="col-md-4 col-lg-4 col-12 mb-3">
                     <label for="clubMember_image" class="form-label">Image</label>
                     <input type="file" name="clubMember_image" id="clubMember_image" class="form-control">
                     <small id="helpId" class="form-text text-danger">@error('clubMember_image')
                         {{$message}}
                     @enderror</small>
                   </div>
                   <div class="col-md-4 col-lg-4 col-12 mb-3">
                     <label for="clubMember_category" class="form-label">Category</label>
                     <select name="clubMember_category" id="clubMember_category" class="form-control">
                       <option value="">Select Member Category</option>
                       @foreach ($category as $cate)
                           <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                       @endforeach
                     </select>
                     <small id="helpId" class="form-text text-danger">@error('clubMember_address')
                         {{$message}}
                     @enderror</small>
                   </div>
                   <div class="col-lg-4 col-md-4 col-12 mb-3">
                     <label for="clubMember_password" class="form-label">Password</label>
                     <input type="password" name="clubMember_password" id="clubMember_password" class="form-control">
                     <small id="helpId" class="form-text text-danger">@error('clubMember_password')
                         {{$message}}
                     @enderror</small>
                   </div>
                  
                   <div class="col-12 col-lg-4 mb-3 d-flex align-items-center">
                     <button type="submit" class="btn btn-primary">Register</button>
                   </div>
                 </div>
                </form>
               </div>
           

               <!-- end of row -->
               <div class="row">
                  <div class="col-md-12">
                     <div class="table-responsive">
                        <table id="table" class="table table-striped">
                           <thead>
                              <tr>
                                <th>Srno</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact #</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                               @php $srNo = 1;  @endphp
                            @foreach ($members as $member)
                                    <tr>
                                        <td>{{$srNo;}}</td>
                                        <td>
                                            <div class="mb-2">
                                                <img src="{{url('Backend/club_images')}}/{{$member->image}}" class="img img-thumbnail d-block mx-auto" style="width:80px; height: 80px;">
                                            </div>
                                        <div class="mb-2 text-center">{{$member->name}}</div>
                                        </td>
                                        <td>{{$member->email}}</td>
                                        <td>{{$member->contact}}</td>
                                        <td>{{Custom::categoryName($member->user_categoryID)}}</td>
                                        <td>{{Custom::status($member->status)}}</td>
                                             <td>
                                                <a href="{{url('clubMembers/edit')}}/{{$member->id}}" class="btn btn-sm btn-success text-white">Edit</a>
                                                <a href="{{url('clubMembers/delete')}}/{{$member->id}}" class="btn btn-sm btn-danger delete-confirm text-white">Delete</a>

                                             </td>
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
