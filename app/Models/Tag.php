<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    protected $primaryKey ='id';

    public function products(){
        return $this->belongsTo(Products::class,'products_tags','tag_id','products_id' );
    }
}
