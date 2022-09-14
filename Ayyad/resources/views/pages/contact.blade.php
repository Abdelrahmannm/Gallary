@extends('layout.master')

@section('title', 'Contact ME')

@section('content')
    <div class="container">
        <h1>{!! $page_name !!}</h1>
        <p>{{ $page_description }}</p>
    </div>
@endsection

@section('sidebar')
    @parent
    This is sidebar from contact
@endsection

