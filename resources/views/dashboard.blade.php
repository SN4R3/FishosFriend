@extends('layouts.main')
@section('title','Dashboard')
@section('content')
  <dash-board :spots="{{$spots}}" :species-list="{{$species}}"/>
@endsection