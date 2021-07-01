<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $table = "videos";
    protected $fillable =['id' , 'name' , 'viewers'];
    public $timestamps = false;

}
