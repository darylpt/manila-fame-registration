<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    protected $fillable = [
        'user_id',
        'company_name',
        'address_line',
        'town_city',
        'region_state',
        'country',
        'year_established',
        'website',
        'brochure_path'
    ];

    // Belong to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
