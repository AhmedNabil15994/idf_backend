<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}"/>

	<title>@yield('title', '--') ||   {{ setting('app_name',locale()) }}</title>
	<meta name="description" content="">
	<link rel="icon" href="{{url(setting('favicon'))}}">
	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/fontawesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/linearicons.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/animate.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/datedropper.css')}}">

	@stack('plugins-styles')

	<link rel="stylesheet" href="{{asset('frontend/'.locale().'/css/style.css')}}?v=1.0.0">
	<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}?v=1.0.0">

	@stack('styles')
</head>
