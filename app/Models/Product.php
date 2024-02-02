<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand',
        'description',
        'image',
        'name',
        'price',
        'stock',
        'category_id'
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeWhereFullText($query, $columns, $search)
    {

        $isPalindrome = $search === strrev($search);


        if ($isPalindrome) {
            $query->selectRaw('*, ROUND(price * 0.5, 2)  as promo_price');
        }

        return $query->where(function ($query) use ($columns, $search) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'like', "%$search%");
            }
        });
    }

}