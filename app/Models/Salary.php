<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    public function admins()
    {
        return $this->belongsTo(Admin::class, 'employee_id');
    }
}
