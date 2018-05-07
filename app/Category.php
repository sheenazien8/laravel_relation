<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[
    	'slug', 'category'
    ];

    public function posts()
    {
    	// menggunakan tabel pivot
    	return $this->belongsToMany(Post::class);
    }
}
