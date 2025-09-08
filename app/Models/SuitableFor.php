<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuitableFor extends Model
{
    use HasFactory;
    protected $table = 'suitable_for';
    protected $primaryKey = 'id';
    
    public function products(){
        return $this->belongsToMany(Products::class, 'products_suitable','products_id','suitable_id');

    }
}
