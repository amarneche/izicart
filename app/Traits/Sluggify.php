<?php
namespace App\Traits;

use Illuminate\Support\Facades\Route;
use Str;
trait Sluggify {

    public static function booted(){
        static::creating(function($model){
            $model->slug= static::slug($model->title);
        });
        
    }  

    public static function slug($str){
        $slug=Str::slug($str);
        //check uniqueness!
        while(static::where('slug',$slug)->get()->count() >0){
            $slug=Str::slug($str.rand(1,1000));
        }
        return $slug;
        
    }
    public function getRouteKeyName(){
        if(Str::contains(Route::currentRouteName(),'customer'))
            return 'slug';
        else
            return 'id';
    }     


}
