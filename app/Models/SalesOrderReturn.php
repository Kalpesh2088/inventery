<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderReturn extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
