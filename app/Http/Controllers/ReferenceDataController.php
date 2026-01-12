<?php

namespace App\Http\Controllers;

use App\Models\EducationLevel;
use App\Models\EmploymentType;
use App\Models\WorkMode;
use App\Models\Industry;
use App\Models\JobCategory;
use App\Models\Skill;
use App\Models\CompanySize;

class ReferenceDataController extends Controller
{
    /**
     * Get all active reference data (status = 1)
     * Public endpoint - no authentication required
     */
    public function index()
    {
        return response()->json([
            'education_levels' => EducationLevel::where('status', 1)->orderBy('rank')->get(),
            'employment_types' => EmploymentType::where('status', 1)->orderBy('rank')->get(),
            'work_modes' => WorkMode::where('status', 1)->orderBy('rank')->get(),
            'industries' => Industry::where('status', 1)->orderBy('rank')->get(),
            'job_categories' => JobCategory::where('status', 1)->orderBy('rank')->get(),
            'skills' => Skill::where('status', 1)->orderBy('rank')->get(),
            'company_sizes' => CompanySize::where('status', 1)->orderBy('rank')->get(),
        ]);
    }

    /**
     * Get active education levels
     */
    public function educationLevels()
    {
        return response()->json(EducationLevel::where('status', 1)->orderBy('rank')->get());
    }

    /**
     * Get active employment types
     */
    public function employmentTypes()
    {
        return response()->json(EmploymentType::where('status', 1)->orderBy('rank')->get());
    }

    /**
     * Get active work modes
     */
    public function workModes()
    {
        return response()->json(WorkMode::where('status', 1)->orderBy('rank')->get());
    }

    /**
     * Get active industries
     */
    public function industries()
    {
        return response()->json(Industry::where('status', 1)->orderBy('rank')->get());
    }

    /**
     * Get active job categories
     */
    public function jobCategories()
    {
        return response()->json(JobCategory::where('status', 1)->orderBy('rank')->get());
    }

    /**
     * Get active skills
     */
    public function skills()
    {
        return response()->json(Skill::where('status', 1)->orderBy('rank')->get());
    }

    /**
     * Get active company sizes
     */
    public function companySizes()
    {
        return response()->json(CompanySize::where('status', 1)->orderBy('rank')->get());
    }
}
