<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateProfile extends Model
{
    protected $fillable = [
        'user_id',
        'resume_link',
        'cover_letter',
        'linkedin_profile',
        'github_profile',
        'portfolio_website',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->hasMany(CandidateSkill::class);
    }

    public function projects()
    {
        return $this->hasMany(CandidateProject::class);
    }
}
