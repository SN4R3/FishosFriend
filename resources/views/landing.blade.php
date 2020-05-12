@extends('layouts.main')
@section('title','Home Page')
@section('content')
  <prefs-select :species-list="{{$species}}"></prefs-select>
@endsection