<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/* usiamo BelongsTo */
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'cover', 'category_id'];

    /* Creiamo una relazione one to many

    Un post puó essere associato ad una categoria, quindi possiamo dire che un post 'appartiene ad una' categoria. A post belongsTo a category. */

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
