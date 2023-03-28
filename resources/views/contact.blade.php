@extends('layouts.main')

@section('content')
    
<!-- Page info section -->
<section class="page-info-section set-bg" data-setbg="{{url('Frontend/img/page-top-bg/5.jpg')}}">
		<div class="pi-content">
			<div class="container">
				<div class="row">
					<div class="col-xl-5 col-lg-6 text-white">
						<h2>Contact us</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page info section -->
    
    
	<!-- Page section -->
	<section class="page-section spad contact-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <h4 class="comment-title">Contact us</h4>
					<p>Odio ultrices ut. Etiam ac erat ut enim maximus accumsan vel ac nisl. Duis feug iat bibendum orci, non elementum urna. Cras sit amet sapien aliquam.</p>
					<div class="row">
                        <div class="col-md-9">
                            <ul class="contact-info-list">
                                <li><div class="cf-left">Address</div><div class="cf-right">1481 Creekside Lane Avila Beach, CA 931</div></li>
								<li><div class="cf-left">Phone</div><div class="cf-right">+53 345 7953 32453</div></li>
								<li><div class="cf-left">E-mail</div><div class="cf-right">yourmail@gmail.com</div></li>
							</ul>
						</div>
					</div>
					<div class="social-links">
						<a href="#"><i class="fa fa-pinterest"></i></a>
						<a href="#"><i class="fa fa-facebook"></i></a>
						<a href="#"><i class="fa fa-twitter"></i></a>
						<a href="#"><i class="fa fa-dribbble"></i></a>
						<a href="#"><i class="fa fa-behance"></i></a>
						<a href="#"><i class="fa fa-linkedin"></i></a>
					</div>
				</div>
				<div class="col-lg-8">
                    <div class="contact-form-warp">
                        <h4 class="comment-title">Leave a Reply</h4>
						<form class="comment-form">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" placeholder="Name">
								</div>
								<div class="col-md-6">
                                    <input type="email" placeholder="Email">
								</div>
								<div class="col-lg-12">
                                    <input type="text" placeholder="Subject">
									<textarea placeholder="Message"></textarea>
									<button class="site-btn btn-sm">Send</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Page section end -->
    
@endsection
    
	