<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header_image extends Model
{
    use HasFactory;
    
    public function Header_image(){
        
        $header_images = $this::select('header_images.*')
                                    ->where('status', 1)
                                    ->orderby('id','ASC')  
                                    ->get();
       
        return $header_images;
    }
}
