<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $limit = $request->input('limit', 15);
        $orders = Order::query();
        return response()->api($orders->paginate($limit));
    }

    public function show(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->api(null, 404);
        }
        return response()->api($order);
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());
        return response()->api($order, 201);
    }


}