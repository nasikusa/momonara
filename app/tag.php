<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    //
	protected $fillable = ['id' , 'name' , 'article_id' , 'page_author_id'];
}
