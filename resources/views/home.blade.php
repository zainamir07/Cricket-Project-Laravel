@extends('layouts.main')

@section('content')


	<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="{{url('Frontend/img/slider-1.jpg')}}">
				<div class="hs-text">
					<div class="container">
						<h2>The Best <span>Games</span> Out There</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada <br> lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. <br>Suspendisse cursus faucibus finibus.</p>
						<a href="#" class="site-btn">Read More</a>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="{{url('Frontend/img/slider-2.jpeg')}}">
				<div class="hs-text">
					<div class="container">
						<h2>The Best <span>Games</span> Out There</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada <br> lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. <br>Suspendisse cursus faucibus finibus.</p>
						<a href="#" class="site-btn">Read More</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Hero section end -->

	<!-- Latest news section -->
	<div class="latest-news-section">
		<div class="ln-title">Latest News & Events</div>
		<div class="news-ticker">
			<div  class="news-ticker-contant">
                 <div  class="nt-item">
					@foreach ($allEvents as $event)
						
					<a class="text-white text-decoration-none" href="events.php?eventID="> 
						<span class='new'>{{Custom::eventType($event->event_type)}}</span>							
							{{$event->event_title}}
						</a>
					</div> 
					@endforeach
					
					{{-- <div  class="nt-item">
								<a class="text-white text-decoration-none" href="events.php"> 
									<span class="new">
										View All News & Events
                                    </span>
                                </a>
                            </div> --}}
                            {{-- <div  class="nt-item">
                                <a class="text-white text-decoration-none" href="javascript:;"> 
                                    <span class="new">
                                        No Event Right Now
                                    </span>
                                </a>
                            </div>                     --}}
       </div>
    </div>
</div>
 
	<!-- Latest news section -->

	<!-- Feature section -->
	<section class="feature-section spad">
		<div class="container">
		<div class="section-title">
				<!-- <div class="cata new">new</div> -->
				<h2>Recent Events</h2>
			</div>
			<div class="row">
				{{--  --}}
				@foreach ($events as $event)
					
				<div class="col-lg-3 col-md-6 p-0">
					<div class="feature-item set-bg" data-setbg="{{url('Backend/event_images')}}/{{$event->event_image}}">
						<span class="cata strategy">{{Custom::eventType($event->event_type)}}</span>
							<div class="fi-content text-white">
								<h5><a href="{{url('viewEvent')}}/{{$event->event_id}}">{{$event->event_title}}</a></h5>
								<p id="event_description">{{$event->event_description}} </p>
								<a href="events.php?eventID=" class="fi-comment">Read More</a>
							</div>
						</div>
					</div>
					
				@endforeach
					{{--  --}}

				</div>
				<div class="container text-center mt-4">
				<a class="btn btn-outline-secondary" href="{{url('viewEvent/E')}}">View All Events</a>
				</div>
			</div>

		</div>
	</section>
	<!-- Feature section end -->


	<!-- Recent game section  -->
	<section class="recent-game-section spad set-bg" data-setbg="img/news_background.jpg" style="background-position: revert;">
		<div class="container">
			<div class="section-title">
				<!-- <div class="cata new">new</div> -->
				<h2 class="text-white">Recent News</h2>
			</div>
			<div class="row">
				@foreach ($news as $event)
					
				<div class="col-lg-3 col-md-6 p-0">
					<div class="feature-item set-bg" data-setbg="{{url('Backend/event_images')}}/{{$event->event_image}}">
						<span class="cata strategy">{{Custom::eventType($event->event_type)}}</span>
							<div class="fi-content text-white">
								<h5><a href="events.php?eventID=">{{$event->event_title}}</a></h5>
								<p id="event_description">{{$event->event_description}} </p>
								<a href="events.php?eventID=" class="fi-comment">Read More</a>
							</div>
						</div>
					</div>
					
				@endforeach
			</div>
			<div class="container text-center mt-4">
			<a class="btn btn-warning" href="{{url('viewEvent/N')}}">View All News</a>
			</div>
		</div>
	</section>
	<!-- Recent game section end -->

@endsection
