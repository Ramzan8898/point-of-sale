<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceProducts;
class Invoice extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function invoice_products(){
    	return $this->hasMany(InvoiceProducts::class);
    }

}
