<?php
namespace App\Traits;
use Storage;

trait MediaUpload {
    //Store in Storage/app/public/

    public function upload ($file){
        try{
            return $file->store('public');
        }
        catch(\Exception $e){
            report($e);
        }
    }
    public function uploadToTenant($file){
        try {
            $id=tenant()->id;
            return $file->store("public/{$id}/images/");
        }
        catch(\Exception $ex){
            report($ex);
        }
    }

    
    public function uploadTo($file,$path){
        try 
    {
        return $file->store($path);
    }
    catch(\Exception $e){
        report($e);
    }
    }
}