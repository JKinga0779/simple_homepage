<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companyinfo extends Model
{
    use HasFactory;

    public function Companyinfo(){
        
        $companyinfo = $this::select('companyinfos.*')
                             ->where('status',1)    
                             ->first();
                                     
        return $companyinfo;
    }
}
