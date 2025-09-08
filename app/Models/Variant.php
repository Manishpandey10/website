<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    protected $table = 'variants';
    protected $primaryKey = 'id';
    protected $fillable = [

        'product_id',
        'sku',
        'size',
        'stock',
        'weight',
        'metaTitle',
        'metaDescription',
        'variantImgTitle',
        'variantImgAltTag',
        'color_id',
        'discount',
        'discountedPrice',
        'price',
        'hsn',
        'gst'
    ];

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
