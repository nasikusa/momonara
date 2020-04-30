<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    //
	protected $fillable = ['id' , 'title' , 'user_id' , 'content' , 'update_count'];
}
