<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        /* $posts= Post::all(); */
        $posts = Post::orderByDesc('id')->get();
        $categories= Category::all();
        $tags= Tag::all();
       /*  dd($posts); */
        return view ('admin.posts.index', compact('posts', 'categories','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories= Category::all();
        /* dd($categories); */
        $tags = Tag::all();
        /* dd($tags) */

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        /* dd($request->all()); */
        /* dd($request->tags); */

        //validiamo i dati
        $val_data = $request->validated();

        //Generiamo lo slug
        $slug = Str::slug($request->title,'-');
        /* $slug = Post::generateSlug($request->title); */

        /* dd($slug); */
        $val_data['slug'] = $slug;

        /* $val_data['category_id'] = $request->category_id; */
        /* dd($val_data); */
        if($request->hasfile('cover')){

            //validiamo il file

            $request->validate([
                'cover' => 'nullable|image|max:500',
            ]);  

            //salvaggio del file nel filesystem

            //recuperiamo il percorso

            /* ddd($request->all()); */
            $path = Storage::put('post_images', $request->cover);

            /* ddd($path); */

            //passiamo il percorso all'array di dati validati per il salvataggio della risorsa
            $val_data['cover']= $path;

        }

        /* dd($val_data); */

        //Creiamo la risorsa (resource)
        $new_post= Post::create($val_data);
        $new_post->tags()->attach($request->tags);

        //verifichiamo se la richiesta contiene un file
        /* ddd($request->hasfile('cover')); */


        //rindirizziamo alla rotta get (get route)
        return redirect()->route('admin.posts.index')->with('message', 'Post creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {   
        
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)

    {
        $categories= Category::all();
        $tags= Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\PostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        /* dd($request->all()); */

        //validazione dati
        /* $val_data=$request->validated(); */
        /* dd($val_data);  */

        $val_data = $request->validate([
            'title'=> ['required', Rule::unique('posts')->ignore($post)],
            'category_id'=> 'nullable|exists:categories,id',
            'tags'=>'exists:tags,id',
            'cover'=> 'nullable',
            'content'=>'nullable',
        ]);

        /* dd($val_data); */

        //generazione dello slug

        $slug = Str::slug($request->title,'-');
       /*  $slug = Post::generateSlug($request->title); */
        /* dd($slug); */
        $val_data['slug'] = $slug;

        if($request->hasfile('cover')){
            //validazione del file

            $request->validate([
                'cover'=> 'nullable|image|max:500',
            ]);

            //salvataggio nel filesystem
            Storage::delete($post->cover);
            //recupero del percorso

            /* ddd($request->all()); */

            $path = Storage::put('post_images', $request->cover);
            /* ddd($path); */

            //passiamo il percorso all'array di dati validati per il salvataggio della risorsa
            $val_data['cover']= $path;

        }
    

        //aggiornamento della risorsa
       
        $post->update($val_data);

        //sync tags
        $post->tags()->sync($request->tags);
        // reindirizzamento alla rotta di tipo get
        return redirect()->route('admin.posts.index')->with('message', "$post->title aggiornato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {   
        Storage::delete($post->cover);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('message', "$post->title rimosso con successo");
    }
}
