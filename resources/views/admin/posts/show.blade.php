@extends('layouts.admin')

@section('content')

<div class="container d-flex flex-column align-items-center my-5">

    <img src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}" class="mb-4">

    <h1 class="mb-4">
        {{$post->title}}
    </h1>

    <div class="metadata py-3">

        <span class="categories"> 
            Category 
            <a href="#">
                {{$post->category ? $post->category->name :'Uncategorized'}}
            </a> 
        </span>
        <!-- /.categories -->

        <span class="tags">
            Tags:
            @if(count($post->tags) > 0)
            @foreach($post->tags as $tag)
            <a href="#">{{$tag->name}} </a>
            @endforeach
            @else
            <span>No tags</span>

            @endif

        </span>
        <!-- /.tags -->

    </div>
    <!-- /.metadata -->




    <div class="content mb-4">
        {{$post->content}}
    </div>



</div>




@endsection