<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\quantity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class QuantityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    //    ------------------------ quantity data ------------------------

    public function quantityDataJson()
    {


        $products = DB::table('quantities')
            ->join('products', 'products.id', '=', 'quantities.product_id')
            ->select('products.*', 'quantities.qty')
            ->paginate(5);

        return $products;


    }

//    ------------------------ quantity data ------------------------


//    ------------------------ quantity data search ------------------------

    public function quantityDataJsonSearch($search)
    {
//        $products = DB::select('SELECT * FROM `products` LEFT JOIN quantiys ON products.id = quantiys.product_id;');

        $products = DB::table('quantities')
            ->join('products', 'products.id', '=', 'quantities.product_id')
            ->select('products.*', 'quantities.qty')
            ->where('product_name', 'LIKE', '%' . $search . '%')
            ->paginate(5);


        return $products;


    }

//    ------------------------ quantity data search------------------------


    public function index()
    {
        return view('admin.admin-content.quantity.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.admin-content.quantity.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $inputs = \request()->validate([
            'product_id' => 'required',
            'qty' => 'required',
        ]);

        $quantity = Quantity::where('product_id', $inputs['product_id'])->update($inputs);

        return response()->json([
            'data' => $quantity,
            'status' => Http::response('Quantity Updated', 200)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\quantity $quantity
     * @return \Illuminate\Http\Response
     */
    public function show(quantity $quantity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\quantity $quantity
     * @return \Illuminate\Http\Response
     */
    public function edit(quantity $quantity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\quantity $quantity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, quantity $quantity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\quantity $quantity
     * @return \Illuminate\Http\Response
     */
    public function destroy(quantity $quantity)
    {
        //
    }
}
