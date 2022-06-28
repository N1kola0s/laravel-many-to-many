@extends('layouts.admin')

@section('content')

<h2 class="my-4">Modifica {{$post->title}}</h2>

@include('partials.errors')

<form action="{{route('admin.posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">

        <label for="title">
            Titolo:
        </label>

        <input type="text" name="title" id="title" class="form-control @error('title') is invalid @enderror" placeholder="es. Come imparare PHP in 7 giorni" aria-describedby="titleHelper" value="{{old('title', $post->title)}}">

        <small id="titleHelper" class="text-muted">
            Scrivi il titolo del post | max 150 caratteri
        </small>

    </div>

    <div class="mb-3">

        <div>
            <img width="100" src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}">
        </div>

        <label for="cover">
            Copertina:
        </label>

        <input type="file" name="cover" id="cover" class="form-control @error('cover') is invalid @enderror" placeholder="es. https://picsum.photos/600/300" aria-describedby="coverHelper" >

        <small id="coverHelper" class="text-muted">
            Inserisci l'immagine copertina del tuo post
        </small>

    </div>

    <div class="form-group">
        <label for="category_id">Categories</label>
        <select class="form-control" name="category_id" id="category_id">
            <option value="">Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}" {{$category->id == old('category', $post->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach

        </select>
    </div>

    <div class="form-group">
        <label for="tags">Tags</label>
        <select multiple class="form-control" name="tags[]" id="tags">
            <option value="">Select a tags</option>
            @forelse ($tags as $tag)

            @if($errors->any())
            <option value="{{$tag->id}}" {{ in_array($tag->id, old('tags', [])) ? 'selected' : ''}}> {{$tag->name}}</option>
            @else
            <option value="{{$tag->id}}" {{ $post->tags->contains($tag->id) ? 'selected' : ''}}> {{$tag->name}}</option>
            @endif

            @empty
            <option value=""> No Tags</option>
            @endforelse
        </select>
    </div>

    <div class="mb-3">

        <label for="content">
            Contenuto del tuo post:
        </label>

        <textarea name="content" id="content" cols="30" rows="10" class="form-control  @error('content') is-invalid @enderror">
        {{old('content', $post->content)}}
        </textarea>

    </div>

    <button type="submit" class="btn btn-primary">
        Modifica Post
    </button>

</form>



@endsection