<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table ='category';
    protected $primaryKey = 'id'; 
    
    public function products()
    {
        return $this->belongsToMany(Products::class,'category_products','products_id','category_id');
    }

    public function subcategory(){
        return $this->hasMany(Category::class, 'parent_id');
    }
    
    public function allChildren()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('allChildren');
    }
    
    public function parents()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
    

}
