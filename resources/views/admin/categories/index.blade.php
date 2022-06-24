@extends('layouts.admin')


@section('content')




@include('partials.sessions')
@include('partials.errors')

<div class="container">

    <h1 class="my-3">Categorie</h1>

    <div class="row">

        <div class="col pe-5">

            <form action="" method="post" class="d-flex align-items-center">
                @csrf
                <div class="input-group mb-3">

                    <input type="text" name="name" class="form-control" placeholder="Scrivi la categoria da aggiungere" aria-label="Scrivi la categoria da aggiungere" aria-describedby="button-addon2">

                    <button class="btn bg-primary text-white mx-3" type="submit" id="button-addon2">
                        Aggiungi
                    </button>

                </div>

            </form>
        </div>

        <div class="col">

            <table class="table table-striped table-inverse table-responsive">

                <thead class="thead-inverse">

                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Slug</th>
                        <th>N. Post</th>
                        <th>Azioni</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($cats as $category)

                    <tr>

                        <td scope="row">
                            {{$category->id}}
                        </td>

                        <td>

                            <form id="category-{{$category->id}}" action="{{route('admin.categories.update', $category->id)}}" method="post">
                                @csrf
                                @method('PATCH')

                                <input class="border-0 bg-transparent" type="text" name="name" value="{{$category->name}}">

                            </form>

                        </td>

                        <td>{{$category->slug}}</td>

                        <td>
                            <span class="badge badge-info bg-light">
                                {{count($category->posts)}}
                            </span>
                        </td>

                        <td>

                            <button form="category-{{$category->id}}" type="submit" class="btn btn-primary my-2">
                                Modifica
                            </button>

                            <form action="{{route('admin.categories.destroy', $category->id)}}" method="post">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger text-white my-2">
                                    Rimuovi
                                </button>

                            </form>

                        </td>

                    </tr>
                    @empty

                    <tr>

                        <td scope="row">
                            Non ci sono categorie. Aggiungi una categoria!
                        </td>

                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


@endsection