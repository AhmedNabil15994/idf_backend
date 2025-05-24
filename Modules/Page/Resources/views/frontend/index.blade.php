@extends('apps::frontend.layouts.app')
@section('title', $page['title'])
@section('content')
@include('apps::frontend.layouts.page-banner',['title' => $page['title'],'background' =>  $background])
@include('page::frontend.pages.'.$blade)
@stop
