<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
