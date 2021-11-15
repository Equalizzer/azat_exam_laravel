<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductsRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function createProducts(CreateProductsRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        $products = Products::create($data);
        return response()->json($products);
    }

    public function updateProducts(CreateProductsRequest $request)
    {
        $products = Auth::guard('api')->user();
        $data = $request->validated();

        if (!$products->save()) {
            return response()->json(['error' => 'User saving error']);
        }

        return response()->json($products);
    }
}
