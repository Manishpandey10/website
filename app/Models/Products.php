<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'id';

    protected $fillable = [
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products_category()
    {
        return $this->belongsToMany(Category::class, 'category_products','category_id','products_id');
    }

    

    public function filters()
    {
        return $this->belongsToMany(Filter::class, 'products_filters', 'products_id', 'filter_id');
    }
    //relation for suitable for 
    public function suitableFor()
    {
        return $this->belongsToMany(SuitableFor::class, 'products_suitable', 'products_id', 'suitable_id');
    }
    //many to many for tags
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'products_tags', 'tag_id', 'products_id');
    }
    public function firstVariantImage()
    {
        return $this->hasOne(VariantImage::class, 'product_id', 'id')->orderBy('id');
    }
    public function firstVariant()
    {
        return $this->hasOne(Variant::class, 'product_id', 'id')->orderBy('id');
    }
    
}
