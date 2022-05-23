<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = ['isbn','title','author','category_id','publisher','published_date'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function inventories(){
        return $this->hasMany(Inventory::class);
    }
}
