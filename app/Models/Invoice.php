<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function invoice_products(){
    	return $this->hasMany(Product::class);
    }
    public function account(){
        return $this->hasOne(Account::class);
    }

}
