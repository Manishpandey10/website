<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;
    protected $table = 'filters';
    protected $primaryKey = 'id';

    public function products(){
        return $this->belongsToMany(Products::class,'products_filters','products_id', 'filter_id');
    }

}
