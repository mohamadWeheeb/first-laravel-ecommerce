@extends('layouts.admin')

@section('PageTitle' , "Show Article" )

@section('content')

<h1 class="text-center">{{ $blog->title }}</h1>
<h4  @if($blog->status == 'active') class="btn btn-success" @endif>{{ $blog->status }}</h4>
<img src="{{ $blog->image_url }}" alt="{{ $blog->title }}" title="{{ $blog->title }}">

<p class="text-center mt-3">{{ $blog->body }}</p>

<div style="margin-bottom: 100px ">

</div>
@endsection
