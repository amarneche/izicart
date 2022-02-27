<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\QuickOrderRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
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
        // dd($request->all());
       
        $customer =Customer::firstOrCreate([
            'phone'=>$request->phone,
            'full_name'=>$request->full_name
        ],[
            'phone'=>$request->phone,
            'full_name'=>$request->full_name,
            'wilaya_id'=>$request->wilaya_id,
            'commune_id'=>$request->commune_id
        ]);
       
        //Create Order
        $order =Order::create(
            [
              'order_number'=>1,
             'shipping_cost'=>500
        ]);
        $orderItem=OrderItem::create([
            'order_id'=>$order->id,
            'product_id'=>$product->id,
            'price'=>$product->price,
        ]);
        dd($orderItem);

        dd('Quick Order');
        return redirect()->route('customer.thank-you');
    }




}
