@extends('layouts.main')
@section('content')
<section class="mb-4">
    <div class="container">
       <div class="row">
          <div class="col-md-12 si-box-padding">
             <section class="common-head-wrapper-sm clearfix">
                <div class="wrapper-head mt-4 mb-4">
                   <h4 class="bg-dark text-white p-3 d-block"><i class="glyphicon glyphicon-th-large"></i><span>All {{$eventName}}</span>
                    <button type="button" class="btn btn-sm btn-warning pull-right" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Add New {{$eventName}}+
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
        <form action="{{url('myEvents')}}/{{$eventType}}" method="post" enctype="multipart/form-data">
            @csrf
       <div class="row">
         <div class="col-md-12 col-lg-12 col-12 mb-3">
            <label for="event_title" class="form-label">{{$eventName}} Title</label>
           <input type="text"
             class="form-control" name="event_title" id="event_title" aria-describedby="helpId" placeholder="Enter Event Title">
             <span class="text-danger">@error('event_title')
                 {{$message}}
             @enderror</span>
         </div>
         <div class="col-md-12 col-lg-12 col-12 mb-3">
           <label for="event_description" class="form-label">Category Description</label>
           <textarea name="event_description" id="event_description" class="form-control" cols="30" rows="10"></textarea>
           <span class="text-danger">@error('event_description')
            {{$message}}
            @enderror</span>
         </div>
         <div class="col-md-6 col-lg-6 col-12 mb-3">
           <label for="event_type" class="form-label">{{$eventName}} Type</label>
          <select name="event_type" id="event_type" class="form-control">
            <option value="">Select Type</option>
            <option value="E" @if ($eventName == 'Event') selected @endif>Event</option>
            <option value="N" @if ($eventName == 'News') selected @endif>News</option>
          </select>
          <span class="text-danger">@error('event_type')
            {{$message}}
            @enderror</span>
         </div>
         <div class="col-md-6 col-lg-6 col-12 mb-3">
            <label for="event_image" class="form-label">{{$eventName}} Image</label>
            <input type="file" name="event_image" id="event_image" class="form-control">
            <span class="text-danger">@error('event_image')
                {{$message}}
            @enderror</span>
          </div>
           <div class="col-12 col-lg-4 mb-3 d-flex align-items-center">
             <button type="submit" name="addNewEventBtn" class="btn btn-primary">Add</button>
           </div>
         </div>
        </form>
       </div>
       </div>
    </div>

    <div class="container">
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
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>

                    @php $srNo = 1; @endphp
                    @foreach ($events as $event)  
                    <tr>
                        <th>{{$srNo}}</th>
                        <th><img src="{{url('Backend/event_images'."/".$event->event_image)}}" width="70px" class="rounded circle" alt=""></th>
                        <th>{{$event->event_title}}</th>
                        <th>{{Custom::status($event->event_status)}}</th>
                        <th>{{($event->created_at)}}</th>
                        <th>
                            <a href="{{url('myEvents/editEvent')}}/{{$event->event_id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
                            <a href="{{url('myEvents/deleteEvent')}}/{{$event->event_id}}" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </tr>
                    @php $srNo++; @endphp
                    @endforeach
                       
                   </tbody>
                </table>
             </div>
          </div>    
       </div>   
    </div> 
</div>
 </section>
           


@endsection