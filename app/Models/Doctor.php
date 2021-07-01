<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'gender',
        'hospital_id',
        'created_at',
        'updated_at'
    ];
    protected $hidden = ['hospital_id' , 'created_at', 'updated_at'];
    public $timestamps = true;

    ########################## Begin Of Relations ############################

    public function hospital(){
        return $this -> belongsTo('App\Models\Hospital', 'hospital_id' , 'id');
    }

    ########################## End Of Relations ############################
}
