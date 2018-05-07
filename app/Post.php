<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	protected $fillabe= [
		'user_id', 'title', 'body'
	];


}
