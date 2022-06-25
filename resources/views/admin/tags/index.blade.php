@extends('layouts.admin')


@section('content')




@include('partials.sessions')
@include('partials.errors')

<div class="container">

    <h1 class="my-3">Tags</h1>

    <div class="row">

        <div class="col pe-5">

            <form action="" method="post" class="d-flex align-items-center">
                @csrf
                <div class="input-group mb-3">

                    <input type="text" name="name" class="form-control" placeholder="Scrivi il tag da aggiungere" aria-label="Scrivi il tag da aggiungere" aria-describedby="button-addon2">

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

                    @forelse($tags as $tag)

                    <tr>

                        <td scope="row">
                            {{$tag->id}}
                        </td>

                        <td>

                            <form id="tag-{{$tag->id}}" action="{{route('admin.tags.update', $tag->id)}}" method="post">
                                @csrf
                                @method('PATCH')

                                <input class="border-0 bg-transparent" type="text" name="name" value="{{$tag->name}}">

                            </form>

                        </td>

                        <td>{{$tag->slug}}</td>

                        <td>
                            <span class="badge badge-info bg-light">
                                {{count($tag->posts)}}
                            </span>
                        </td>

                        <td>

                            <button form="tag-{{$tag->id}}" type="submit" class="btn btn-primary my-2">
                                Modifica
                            </button>

                            <form action="{{route('admin.tags.destroy', $tag->id)}}" method="post">

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
                            Non ci sono tag. Aggiungi un tag!
                        </td>

                    </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


@endsection