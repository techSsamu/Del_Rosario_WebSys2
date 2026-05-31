<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'revenue',
        'expenses',
        'units_sold',
        'category',
        'sale_date'
    ];
}
