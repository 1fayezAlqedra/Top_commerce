<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['name', 'image', 'parent_id'];


    //relationship to get the category Name from category_id
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->withDefault();
    }
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function Products()
    {

        return $this->hasMany(Product::class);
    }
}
