<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EducationLevel;
use App\Models\EmploymentType;
use App\Models\WorkMode;
use App\Models\Industry;
use App\Models\JobCategory;
use App\Models\Skill;
use App\Models\CompanySize;
use Illuminate\Http\Request;

class ReferenceDataController extends Controller
{
    /**
     * Get all reference data (all tables)
     */
    public function index()
    {
        return response()->json([
            'education_levels' => EducationLevel::orderBy('rank')->get(),
            'employment_types' => EmploymentType::orderBy('rank')->get(),
            'work_modes' => WorkMode::orderBy('rank')->get(),
            'industries' => Industry::orderBy('rank')->get(),
            'job_categories' => JobCategory::orderBy('rank')->get(),
            'skills' => Skill::orderBy('rank')->get(),
            'company_sizes' => CompanySize::orderBy('rank')->get(),
        ]);
    }

    // ==================== EDUCATION LEVELS ====================

    public function getEducationLevels()
    {
        return response()->json(EducationLevel::orderBy('rank')->get());
    }

    public function storeEducationLevel(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:education_levels',
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $educationLevel = EducationLevel::create($validated);

        return response()->json([
            'message' => 'Education level created successfully',
            'data' => $educationLevel,
        ], 201);
    }

    public function updateEducationLevel(Request $request, $id)
    {
        $educationLevel = EducationLevel::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:education_levels,name,' . $id,
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $educationLevel->update($validated);

        return response()->json([
            'message' => 'Education level updated successfully',
            'data' => $educationLevel,
        ]);
    }

    public function deleteEducationLevel($id)
    {
        $educationLevel = EducationLevel::findOrFail($id);
        $educationLevel->delete();

        return response()->json([
            'message' => 'Education level deleted successfully',
        ]);
    }

    // ==================== EMPLOYMENT TYPES ====================

    public function getEmploymentTypes()
    {
        return response()->json(EmploymentType::orderBy('rank')->get());
    }

    public function storeEmploymentType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employment_types',
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $employmentType = EmploymentType::create($validated);

        return response()->json([
            'message' => 'Employment type created successfully',
            'data' => $employmentType,
        ], 201);
    }

    public function updateEmploymentType(Request $request, $id)
    {
        $employmentType = EmploymentType::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:employment_types,name,' . $id,
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $employmentType->update($validated);

        return response()->json([
            'message' => 'Employment type updated successfully',
            'data' => $employmentType,
        ]);
    }

    public function deleteEmploymentType($id)
    {
        $employmentType = EmploymentType::findOrFail($id);
        $employmentType->delete();

        return response()->json([
            'message' => 'Employment type deleted successfully',
        ]);
    }

    // ==================== WORK MODES ====================

    public function getWorkModes()
    {
        return response()->json(WorkMode::orderBy('rank')->get());
    }

    public function storeWorkMode(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:work_modes',
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $workMode = WorkMode::create($validated);

        return response()->json([
            'message' => 'Work mode created successfully',
            'data' => $workMode,
        ], 201);
    }

    public function updateWorkMode(Request $request, $id)
    {
        $workMode = WorkMode::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:work_modes,name,' . $id,
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $workMode->update($validated);

        return response()->json([
            'message' => 'Work mode updated successfully',
            'data' => $workMode,
        ]);
    }

    public function deleteWorkMode($id)
    {
        $workMode = WorkMode::findOrFail($id);
        $workMode->delete();

        return response()->json([
            'message' => 'Work mode deleted successfully',
        ]);
    }

    // ==================== INDUSTRIES ====================

    public function getIndustries()
    {
        return response()->json(Industry::orderBy('rank')->get());
    }

    public function storeIndustry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:industries',
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $industry = Industry::create($validated);

        return response()->json([
            'message' => 'Industry created successfully',
            'data' => $industry,
        ], 201);
    }

    public function updateIndustry(Request $request, $id)
    {
        $industry = Industry::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:industries,name,' . $id,
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $industry->update($validated);

        return response()->json([
            'message' => 'Industry updated successfully',
            'data' => $industry,
        ]);
    }

    public function deleteIndustry($id)
    {
        $industry = Industry::findOrFail($id);
        $industry->delete();

        return response()->json([
            'message' => 'Industry deleted successfully',
        ]);
    }

    // ==================== JOB CATEGORIES ====================

    public function getJobCategories()
    {
        return response()->json(JobCategory::orderBy('rank')->get());
    }

    public function storeJobCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:job_categories',
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $jobCategory = JobCategory::create($validated);

        return response()->json([
            'message' => 'Job category created successfully',
            'data' => $jobCategory,
        ], 201);
    }

    public function updateJobCategory(Request $request, $id)
    {
        $jobCategory = JobCategory::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:job_categories,name,' . $id,
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $jobCategory->update($validated);

        return response()->json([
            'message' => 'Job category updated successfully',
            'data' => $jobCategory,
        ]);
    }

    public function deleteJobCategory($id)
    {
        $jobCategory = JobCategory::findOrFail($id);
        $jobCategory->delete();

        return response()->json([
            'message' => 'Job category deleted successfully',
        ]);
    }

    // ==================== SKILLS ====================

    public function getSkills()
    {
        return response()->json(Skill::orderBy('rank')->get());
    }

    public function storeSkill(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills',
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $skill = Skill::create($validated);

        return response()->json([
            'message' => 'Skill created successfully',
            'data' => $skill,
        ], 201);
    }

    public function updateSkill(Request $request, $id)
    {
        $skill = Skill::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:skills,name,' . $id,
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $skill->update($validated);

        return response()->json([
            'message' => 'Skill updated successfully',
            'data' => $skill,
        ]);
    }

    public function deleteSkill($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return response()->json([
            'message' => 'Skill deleted successfully',
        ]);
    }

    // ==================== COMPANY SIZES ====================

    public function getCompanySizes()
    {
        return response()->json(CompanySize::orderBy('rank')->get());
    }

    public function storeCompanySize(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:company_sizes',
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $companySize = CompanySize::create($validated);

        return response()->json([
            'message' => 'Company size created successfully',
            'data' => $companySize,
        ], 201);
    }

    public function updateCompanySize(Request $request, $id)
    {
        $companySize = CompanySize::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:company_sizes,name,' . $id,
            'rank' => 'nullable|integer',
            'status' => 'nullable|in:0,1',
        ]);

        $companySize->update($validated);

        return response()->json([
            'message' => 'Company size updated successfully',
            'data' => $companySize,
        ]);
    }

    public function deleteCompanySize($id)
    {
        $companySize = CompanySize::findOrFail($id);
        $companySize->delete();

        return response()->json([
            'message' => 'Company size deleted successfully',
        ]);
    }
}
