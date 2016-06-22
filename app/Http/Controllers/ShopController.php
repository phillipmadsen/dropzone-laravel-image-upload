<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('frontend.shop.index', ['products' => $products]);
    }

    /**
     * Display the specified product.
     *
     * @param  int        $id
     * @return Response
     */
    public function product($id)
    {
        //$product = Product::findBySlug($slug);
        $product = $this->productRepository->findWithoutFail($id);

        // return view('frontend.shop.product', ['product' => Product::findBySlug($slug)]);
        return view('frontend.shop.product', compact('product', $product));

    }
}
