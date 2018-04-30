<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $fillable =[
  	'user_id', 'phone', 'address',
  ];

  public function user()
  {
  	// belongsto artinya model ini memiliki tempat di model user
  	return $this->belongsTo(User::class);
  }
}
