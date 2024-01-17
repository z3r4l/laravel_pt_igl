<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    // protected $with = ['item_invoice'];


    public function item_invoice()
    {
        return $this->hasMany(ItemInvoice::class, 'invoice_id');
    }
}
