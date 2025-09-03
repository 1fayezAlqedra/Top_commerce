<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //   public function parent()
//     {
//         return $this->belongsTo(Category::class, 'parent_id')->withDefault();
//     }


    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'sale_price',
        'quntity',
        'category_id',
    ];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


}
