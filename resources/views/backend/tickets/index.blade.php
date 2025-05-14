@extends('backend.tickets.layout')
@section('content')
@if(isset($view)&&$view=='list')
  @include('backend.tickets.list')
@else
  @include('backend.tickets.tablero')
@endif
@endsection