<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topper extends Model
{
    protected $fillable = ['name','description','course','exm_session','img_path'];
}
