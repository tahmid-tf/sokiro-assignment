<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Quantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */


//    ------------------------ Product and quantity data ------------------------

    public function productDataJson()
    {
//        $products = DB::select('SELECT * FROM `products` LEFT JOIN quantiys ON products.id = quantiys.product_id;');

        $products = DB::table('products')
            ->join('quantities', 'products.id', '=', 'quantities.product_id')
            ->select('products.*', 'quantities.qty')
//            ->where('product_name',"tahmid.tf2@gmail.com")
            ->paginate(2);


        return $products;


    }

//    ------------------------ Product and quantity data ------------------------


//    ------------------------ Product and quantity data search ------------------------

    public function productDataJsonSearch($search)
    {
//        $products = DB::select('SELECT * FROM `products` LEFT JOIN quantiys ON products.id = quantiys.product_id;');

        $products = DB::table('products')
            ->join('quantities', 'products.id', '=', 'quantities.product_id')
            ->select('products.*', 'quantities.qty')
            ->where('product_name', 'LIKE', '%' . $search . '%')
            ->paginate(2);


        return $products;


    }

//    ------------------------ Product and quantity data search------------------------


    public function index()
    {
        return view('admin.admin-content.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admin-content.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $inputs = \request()->validate([
            'product_name' => 'required',
            'product_price' => 'required',
            'product_stock' => 'required',
        ]);

        $product = Product::create($inputs);

        Quantity::create([
            'product_id' => $product->id
        ]);

        return $product;

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
