<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
   
     /**
     * The posts that belong to the Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts(): BelongsToMany
    {   
         /* Creiamo una relazione many to many

        Un post puó essere associato a più tags, quindi possiamo dire che un post 'appartiene ad u più di un tag'. A post belongsToMany tags. */
        return $this->belongsToMany(Post::class);
    }
}
