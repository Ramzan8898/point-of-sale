<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InvoiceProducts;
use App\Models\Account;
class Invoice extends Model
{
    protected $primaryKey = 'invoice_number';
    use HasFactory;
    protected $guarded=[];

    public function invoice_products(){
    	return $this->hasMany(InvoiceProducts::class , "invoice_id" , "invoice_number");
    }
    public function account(){
        return $this->belongsTo(Account::class , "customer_id");
    }
}
