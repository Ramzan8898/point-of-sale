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
    	return $this->belongsToMany(InvoiceProducts::class , 'invoice_products')->withPivot(['quantity']);
    }
    public function account(){
        return $this->hasOne(Account::class);
    }

}
