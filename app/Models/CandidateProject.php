<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateProject extends Model
{
    protected $fillable = [
        'candidate_profile_id',
        'project_title',
        'project_description',
        'technologies_used',
        'project_link',
    ];

    public function candidateProfile()
    {
        return $this->belongsTo(CandidateProfile::class);
    }
}
