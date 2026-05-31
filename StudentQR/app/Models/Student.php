<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'id_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'department',
        'year_level',
        'picture',
        'qr_code',
    ];

    /**
     * Get the student's full name
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the picture URL
     */
    public function getPictureUrlAttribute(): string
    {
        return $this->picture ? asset("storage/{$this->picture}") : asset('images/placeholder.png');
    }
}
