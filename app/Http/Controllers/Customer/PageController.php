<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Http\Request;
use View;

class PageController extends Controller
{
    public function index(Tenant $tenant){
        
        $featuredProducts= Product::paginate(9);
        
        return view("customer.clean.homepage" ,compact('featuredProducts')  );
    }
    public function serveCSS(){
        //load tenant config files 

        //
        return  response()
                    ->view('customer.clean.assets.css')                
                    ->header('Content-Type', 'text/css');
        

        return view('customer.clean.assets.css', );

    }
    public function showCartPage(){

        return view('customer.clean.cart');
    }
    public function showCheckoutPage(){ 
        
        return view('customer.clean.checkout');
    }
    public function showThankyouPage(){
        return ;
    }
}
