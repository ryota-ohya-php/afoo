<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function lendings(){
        return $this->hasMany(Lending::class);
    }
}
