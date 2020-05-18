@extends('layouts.main')
@section('title','Preferences')
@section('content')
  <prefs-select :species-list="{{$species}}"></prefs-select>
@endsection