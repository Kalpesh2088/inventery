<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferStock extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id');
    }
    public function warehouses()
    {
        return $this->belongsTo(Warehouses::class, 'warehouses_id');
    }
}
