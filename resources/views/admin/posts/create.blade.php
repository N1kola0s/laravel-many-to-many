@extends('layouts.admin')

@section('content')

<h2 class="my-4">Crea un nuovo post</h2>

@include('partials.errors')

<form action="{{route('admin.posts.store')}}" method="post">
    @csrf

    <div class="mb-3">

        <label for="title">
            Titolo:
        </label>

        <input type="text" name="title" id="title" class="form-control @error('title') is invalid @enderror" placeholder="es. Come imparare PHP in 7 giorni" aria-describedby="titleHelper" value="{{old('title')}}">

        <small id="titleHelper" class="text-muted">
            Scrivi il titolo del post | max 150 caratteri
        </small>

    </div>

    <div class="mb-3">

        <label for="cover">
            Copertina:
        </label>

        <input type="text" name="cover" id="cover" class="form-control @error('cover') is invalid @enderror" placeholder="es. https://picsum.photos/600/300" aria-describedby="coverHelper" value="{{old('cover')}}">

        <small id="coverHelper" class="text-muted">
            Inserisci l'immagine copertina del tuo post
        </small>

    </div>

    <div class="form-group">
        <label for="category_id">Categories</label>
        <select class="form-control" name="category_id" id="category_id">
            
            <option selected disabled>Select a category</option>
            @foreach($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach

        </select>
    </div>

    <div class="mb-3">

        <label for="content">
            Contenuto del tuo post:
        </label>

        <textarea name="content" id="content" cols="30" rows="10" class="form-control  @error('content') is-invalid @enderror">
        {{old('content')}}
        </textarea>

    </div>

    <button type="submit" class="btn btn-primary">
        Aggiungi Post
    </button>

</form>

@endsection