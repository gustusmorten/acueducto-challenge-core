<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $limit = $request->input('limit', 15);
        $products = Product::query()
            ->when($search, function ($query, $search) {
                return $query->whereFullText(['name', 'brand', 'description'], $search);
            });

        if ($category) {
            $products->where('category_id', $category);
        }
        return response()->api($products->paginate($limit));
    }

    public function show(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->api(null, 404);
        }
        return response()->api($product);
    }

}