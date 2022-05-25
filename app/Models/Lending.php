<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    use HasFactory;
    const CREATED_AT=null;
    const UPDATED_AT=null;

    public function members(){
        return $this->belongTo(Member::class);
    }

    public function inventory(){
        return $this->belongsTo(Inventory::class);
    }
}
