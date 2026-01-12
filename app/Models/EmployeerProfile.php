<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeerProfile extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'website',
        'location',
        'industry',
        'company_size',
        'about_company',
        'logo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
