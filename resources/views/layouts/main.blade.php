@include('layouts.head')
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

@include('layouts.header')

@yield('content')

@include('layouts.footer')
@include('layouts.jsfiles')
