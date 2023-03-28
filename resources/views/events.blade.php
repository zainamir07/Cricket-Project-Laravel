	@extends('layouts.main')

    @section('content')
        
    <!-- Page info section -->
	<section class="page-info-section set-bg" data-setbg="{{url('Frontend/img/page-top-bg/3.jpg')}}">
		<div class="pi-content">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-lg-6 text-white">
						<h2>News & Events</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page info section -->

            
	<!-- Page section -->
	<section class="page-section review-page spad">
 
 
 {{--  --}}
                        @foreach ($events as $event)
                            
                        <div class="container">
                            <div class="row">
                               <div class="col-md-12 pt-3 pb-3 mb-4 shadow rounded-3">
                                <div class="eventlist">
                                  <div class="row">
                                    <div class="col-md-6" style="height: 300px;">
                                          <img src="{{url('Backend/event_images')}}/{{$event->event_image}}" class="img img-thumbnail d-block w-100 h-100" alt="">
                                  </div>
                                    <div class="col-md-6">
                                      <p>
                                        <span class="text-lg">{{$event->created_at}}</span>
                                      </p>
                                      <strong class='text-primary'>{{Custom::eventType($event->event_type)}}</strong>
                                      <br>
                                      <strong>{{$event->event_title}}</strong>
                                      <p>{{$event->event_description}}</p>
                                        {{-- <a href = "events.php?eventID=" class="btn btn-sm btn-primary" > View Details </a> --}}
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @endforeach
                            
                        {{--  --}}
    @endsection
                            