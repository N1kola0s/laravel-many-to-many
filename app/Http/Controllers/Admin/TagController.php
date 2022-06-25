<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::orderByDesc('id')->get();

        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         /* dd($request->all()); */

        //Validazione dati

        $val_data= $request->validate([
            /* 'name' => 'required|unique:categories' */
            'name'=> ['required', 'unique:tags']
        ]);

        //Generazione Slug

        $slug = Str::slug($request->name);

        /* dd($slug); */

        $val_data['slug'] = $slug;

        //Salvataggio dati

        Tag::create($val_data);

        //Reindirizzamento

        return redirect()->back()->with('message', "Il tag è stata aggiunto con successo");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
         /* dd($request->all()) */

        //dd($request->all());

        $val_data = $request->validate([
            'name' => ['required', Rule::unique('tags')->ignore($tag)]
        ]);
        // generate slug
        $slug = Str::slug($request->name);
        $val_data['slug'] = $slug;

        $tag->update($val_data);
        return redirect()->back()->with('message', "Il tag '$tag->name' è stato modificato con successo");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->back()->with('message', "Il tag '$tag->name' è stato rimosso con successo");
    }
}
