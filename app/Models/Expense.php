<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(ExpenseCategories::class, 'category_id');
    }
}
