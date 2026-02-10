<?php
use \Carbon\Carbon;

$currentYear = Carbon::now()->year;
?>
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="keywords" content="" />
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Laravel') }}</title>

	<link href="" type="image/x-icon" rel="icon" />

	<!-- Styles -->
	<link href="{{ mix('css/app.css') }}" rel="stylesheet">
	<link href="{{ mix('css/tailwind.css') }}" rel="stylesheet">

	<!-- Bootswatch Cerulean CSS -->
	<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
	<!-- Livewire CSS -->

</head>
<body class="bg-primary-subtle bg-opacity-75 min-vh-100 d-flex flex-column" data-route="{{ Route::currentRouteName() }}">

	<!-- 1st nav -->
	@include('layouts.navbar')
	<!-- 1st nav end -->

		<!-- 2nd nav -->
		@include('layouts.navmiddle')
		<!-- 2nd nav end -->

	<div class="col-sm-12 mx-auto d-flex flex-fill justify-content-evenly p-1">

		<div class="col-sm-2 m-0">
			<!-- left side menu -->
			@include('layouts.navleftside')
			<!-- left side menu end -->
		</div>


		<div class="col-sm-7 m-0 my-2 p-1 align-self-center">
			<div class="col-sm-12">
				<!-- error message -->
				@include('layouts.messages')
				<!-- error message end -->
			</div>
		<!-- content -->
		@isset($slot)
			<div class="tw">{{ $slot }}</div>
		@endisset
		@yield('content')
		<!-- content end -->
		</div>

		<div class="col-sm-2 m-0 p-1">
			<!-- right side info -->
			@include('layouts.inforightside')
			<!-- right side info end -->
		</div>

	</div>
	<!-- footer -->
	<div class="container m-0 mx-auto py-1 align-self-end text-center text-sm text-light-emphasis">
		&copy; My Themes<br />Themes By Bootswatch<br />
		Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
	</div>
	<!-- footer end -->
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('js/ckeditor/adapters/jquery.js') }}"></script>
<script>
{{-- ✅ Page data injection --}}
	@yield('js')
</script>
<!-- <script type="module">
	jQuery.noConflict ();
	(function($){
		$(document).ready(function(){
			$.get('/sanctum/csrf-cookie').done(function(){
				@section('js-')
				@show
			});
		});
	})(jQuery);
</script>
 -->
 </html>

