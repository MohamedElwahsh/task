<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'created_at',
        'updated_at'

    ];
    protected $hidden = ['created_at' , 'updated_at'];
    public $timestamps = true;

    ########################## Begin Of Relations ############################

    public function doctors(){
        return $this -> hasMany('App\Models\Doctor', 'hospital_id' , 'id');
    }

    ########################## End Of Relations ############################
}
