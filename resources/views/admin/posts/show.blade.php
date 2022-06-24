@extends('layouts.admin')

@section('content')

<div class="container d-flex flex-column align-items-center my-5">

    <img src="{{$post->cover}}" alt="{{$post->title}}" class="mb-4">

    <h1 class="mb-4">
        {{$post->title}}
    </h1>
    <h4 class="text-primary"> Category: {{$post->category ? $post->category->name :'Uncategorized'}}</h4>

    <div class="content mb-4">
        {{$post->content}}
    </div>

</div>




@endsection