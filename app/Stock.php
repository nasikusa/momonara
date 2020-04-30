<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['user_id' , 'stock_id' , 'stocked_author_id'];
}
