<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\QuickOrderRequest;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::paginate(12);
        return view('customer.clean.products.index' ,compact('products'));
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('customer.clean.products.show', compact('product'));
    }
    public function addToCart(Product $product){
        dd('Add to cart');
    }
    public function quickOrder(QuickOrderRequest $request, Product $product){
        //Create or get customer 
        dd($request->all());
        Customer::firstOrCreate([]);
        //Create Order

        //Add Order items


        dd('Quick Order');
        return redirect()->route('customer.thank-you');
    }




}
