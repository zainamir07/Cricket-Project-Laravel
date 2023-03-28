@extends('admin.layout.main')
@section('content')
      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">News</h1>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official DataTables documentation</a>.</p>
            @if (session()->has('error'))
            <div class="alert alert-danger">{{session()->get('error')}}</div>
          @endif
          @if (session()->has('success'))
          <div class="alert alert-success">{{session()->get('success')}}</div>
          @endif
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <button type="button" class="btn btn-primary mb-3" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        Add News+
                      </button>
                </h6>
            </div>
            <div class="container mb-5 collapse" id="collapseExample">
                <form action="{{route('admin.events')}}" method="post" enctype="multipart/form-data">
                    @csrf
               <div class="row">
                 <div class="col-md-12 col-lg-12 col-12 mb-3">
                   <label for="event_title" class="form-label">Event Title</label>
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
                   <label for="event_type" class="form-label">Event Type</label>
                  <select name="event_type" id="event_type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="E">Event</option>
                    <option value="N" selected>News</option>
                  </select>
                  <span class="text-danger">@error('event_type')
                    {{$message}}
                    @enderror</span>
                 </div>
                 <div class="col-md-6 col-lg-6 col-12 mb-3">
                    <label for="event_image" class="form-label">Event Image</label>
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
           

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            @foreach ($news as $event)  
                            <tr>
                                <th>{{$srNo}}</th>
                                <th><img src="{{url('Backend/event_images'."/".$event->event_image)}}" width="70px" class="rounded circle" alt=""></th>
                                <th>{{$event->event_title}}</th>
                                <th>{{Custom::status($event->event_status)}}</th>
                                <th>{{($event->created_at)}}</th>
                                <th>
                                    <a href="{{url('admin/events/editEvent')}}/{{$event->event_id}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> 
                                    <a href="{{url('admin/events/delete')}}/{{$event->event_id}}" class="btn btn-sm deleteBtn btn-danger"><i class="fa fa-trash"></i></a>
                            </tr>
                            @php $srNo++; @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    
@endsection



