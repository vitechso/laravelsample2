<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
	protected $table = 'comment_onpost';
    protected $primaryKey = 'id';
    protected $guarded =[];

   
}