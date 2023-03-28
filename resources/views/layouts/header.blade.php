<header class="header-section">
		<div class="container">
			<!-- logo -->
			<a class="site-logo" href="{{route('home')}}">
				<img src="{{url('Frontend/img/logo.png')}}" alt="">
			</a>
			@if (Auth::guard('clubManager')->check())
			<div class="user-panel ">
				<a href="{{ route('club.logout') }}" class="text-decoration-none">Notifications</a>
			</div>
			
			<div class="user-panel ">
				<a href="javascript:;" class=" dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
					Welcome {{Auth::guard('clubManager')->user()->name}}
				  <span class="badge bg-danger " id="counterMsg"></span>
				</a>
				<ul class="dropdown-menu" >
				  <li><a class="dropdown-item" href="{{route('dashboard')}}">My Dashboard</a></li>
				  <li><a class="dropdown-item" href="{{route('profile')}}">My Profile</a></li>
				  <li><a class="dropdown-item" href="{{route('clubMembers')}}">Members</a></li>
				  <li><a class="dropdown-item" href="{{route('clubTeams')}}">Teams</a></li>
				  <li><a class="dropdown-item" href="{{route('clubCoaches')}}">Coaches</a></li>
				  <li><a class="dropdown-item" href="{{route('clubMatches')}}">Matches</a></li>
				  <li><a class="dropdown-item" href="{{url('myEvents/E')}}">Events</a></li>
				  <li><a class="dropdown-item" href="{{url('myEvents/N')}}">News</a></li>
				  <li><a class="dropdown-item" href="{{url('changePassword')}}">Change Password</a></li>
				  <li><a class="dropdown-item" href="{{ route('club.logout') }}">Logout</a></li>
				</ul>
			</div>
			@elseif (Auth::guard('web')->check())
			<div class="user-panel ">
				<a href="{{ route('club.logout') }}" class="text-decoration-none">Notifications</a>
			</div>
			
			<div class="user-panel ">
				<a href="javascript:;" class=" dropdown-toggle text-decoration-none" data-bs-toggle="dropdown">
					Welcome {{Auth::guard('web')->user()->name}}
				  <span class="badge bg-danger " id="counterMsg"></span>
				</a>
				<ul class="dropdown-menu" >
				  <li><a class="dropdown-item" href="{{route('user_dashboard')}}">My Dashboard</a></li>
				</ul>
			</div>
			@else
			<div class="user-panel ">
				<a href="{{route('club.login')}}" class="text-decoration-none">Club Login</a> / 
				<a href="{{route('user.login')}}" class="text-decoration-none">User Login</a> /
				<a class="text-decoration-none" href="registration.php">Club Register</a>
			</div>
			@endif
			<!-- responsive -->
			<div class="nav-switch">
				<i class="fa fa-bars"></i>
			</div>
			<!-- site menu -->
			<nav class="main-menu">
				<ul>
					<li><a href="{{route('home')}}">Home</a></li>
					<li><a href="{{route('viewAllEvents')}}">News & Events</a></li>
					<li><a href="{{route('contact-us')}}">Contact</a></li>
				</ul>
			</nav>
		</div>
	</header>

		