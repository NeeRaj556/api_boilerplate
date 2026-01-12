<?php

namespace App\Http\Controllers;

use App\Models\CandidateProfile;
use App\Models\CandidateSkill;
use App\Models\CandidateProject;
use App\Models\EmployeerProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    /**
     * Get authenticated user's profile with related data
     */
    public function getProfile()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role === 'candidate') {
            $profile = $user->candidateProfile()->with(['skills', 'projects'])->first();
            return response()->json([
                'user' => $user,
                'profile' => $profile,
            ]);
        } elseif ($user->role === 'employer') {
            $profile = $user->employeerProfile;
            return response()->json([
                'user' => $user,
                'profile' => $profile,
            ]);
        }

        return response()->json([
            'user' => $user,
            'profile' => null,
        ]);
    }

    /**
     * Update or create candidate profile
     */
    public function updateCandidateProfile(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can update candidate profile'], 403);
        }

        $validated = $request->validate([
            'cover_letter' => 'nullable|string',
            'linkedin_profile' => 'nullable|string|url',
            'github_profile' => 'nullable|string|url',
            'portfolio_website' => 'nullable|string|url',
        ]);

        $profile = CandidateProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return response()->json([
            'message' => 'Candidate profile updated successfully',
            'profile' => $profile,
        ]);
    }

    /**
     * Upload resume file
     */
    public function uploadResume(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can upload resume'], 403);
        }

        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // Max 5MB
        ]);

        // Get or create profile
        $profile = CandidateProfile::firstOrCreate(['user_id' => $user->id]);

        // Delete old resume if exists
        if ($profile->resume_link && Storage::disk('public')->exists($profile->resume_link)) {
            Storage::disk('public')->delete($profile->resume_link);
        }

        // Store new resume
        $file = $request->file('resume');
        $filename = time() . '_' . $user->id . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('resumes', $filename, 'public');

        // Update profile with new resume path
        $profile->resume_link = $path;
        $profile->save();

        return response()->json([
            'message' => 'Resume uploaded successfully',
            'resume_link' => $path,
            'resume_url' => asset('storage/' . $path),
            'profile' => $profile,
        ], 201);
    }

    /**
     * Delete resume file
     */
    public function deleteResume()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can delete resume'], 403);
        }

        $profile = $user->candidateProfile;

        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        if (!$profile->resume_link) {
            return response()->json(['error' => 'No resume found to delete'], 404);
        }

        // Delete file from storage
        if (Storage::disk('public')->exists($profile->resume_link)) {
            Storage::disk('public')->delete($profile->resume_link);
        }

        // Remove link from database
        $profile->resume_link = null;
        $profile->save();

        return response()->json([
            'message' => 'Resume deleted successfully',
        ]);
    }

    /**
     * Get resume download URL
     */
    public function getResume()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates have resumes'], 403);
        }

        $profile = $user->candidateProfile;

        if (!$profile || !$profile->resume_link) {
            return response()->json(['error' => 'No resume found'], 404);
        }

        return response()->json([
            'resume_link' => $profile->resume_link,
            'resume_url' => asset('storage/' . $profile->resume_link),
        ]);
    }

    /**
     * Update or create employer profile
     */
    public function updateEmployerProfile(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'employer') {
            return response()->json(['error' => 'Only employers can update employer profile'], 403);
        }

        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'website' => 'nullable|string|url',
            'location' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'company_size' => 'nullable|string|max:50',
            'about_company' => 'nullable|string',
            'logo' => 'nullable|string',
        ]);

        $profile = EmployeerProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return response()->json([
            'message' => 'Employer profile updated successfully',
            'profile' => $profile,
        ]);
    }

    /**
     * Add skill to candidate profile
     */
    public function addSkill(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can add skills'], 403);
        }

        $profile = CandidateProfile::firstOrCreate(['user_id' => $user->id]);

        $validated = $request->validate([
            'skill_name' => 'required|string|max:255',
            'proficiency_level' => 'nullable|string|in:beginner,intermediate,advanced,expert',
        ]);

        $skill = CandidateSkill::create([
            'candidate_profile_id' => $profile->id,
            'skill_name' => $validated['skill_name'],
            'proficiency_level' => $validated['proficiency_level'] ?? null,
        ]);

        return response()->json([
            'message' => 'Skill added successfully',
            'skill' => $skill,
        ], 201);
    }

    /**
     * Update a skill
     */
    public function updateSkill(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can update skills'], 403);
        }

        $profile = $user->candidateProfile;
        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        $skill = CandidateSkill::where('id', $id)
            ->where('candidate_profile_id', $profile->id)
            ->firstOrFail();

        $validated = $request->validate([
            'skill_name' => 'sometimes|required|string|max:255',
            'proficiency_level' => 'nullable|string|in:beginner,intermediate,advanced,expert',
        ]);

        $skill->update($validated);

        return response()->json([
            'message' => 'Skill updated successfully',
            'skill' => $skill,
        ]);
    }

    /**
     * Delete a skill
     */
    public function deleteSkill($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can delete skills'], 403);
        }

        $profile = $user->candidateProfile;
        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        $skill = CandidateSkill::where('id', $id)
            ->where('candidate_profile_id', $profile->id)
            ->firstOrFail();

        $skill->delete();

        return response()->json([
            'message' => 'Skill deleted successfully',
        ]);
    }

    /**
     * Add project to candidate profile
     */
    public function addProject(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can add projects'], 403);
        }

        $profile = CandidateProfile::firstOrCreate(['user_id' => $user->id]);

        $validated = $request->validate([
            'project_title' => 'required|string|max:255',
            'project_description' => 'nullable|string',
            'project_link' => 'nullable|string|url',
        ]);

        $project = CandidateProject::create([
            'candidate_profile_id' => $profile->id,
            'project_title' => $validated['project_title'],
            'project_description' => $validated['project_description'] ?? null,
            'project_link' => $validated['project_link'] ?? null,
        ]);

        return response()->json([
            'message' => 'Project added successfully',
            'project' => $project,
        ], 201);
    }

    /**
     * Update a project
     */
    public function updateProject(Request $request, $id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can update projects'], 403);
        }

        $profile = $user->candidateProfile;
        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        $project = CandidateProject::where('id', $id)
            ->where('candidate_profile_id', $profile->id)
            ->firstOrFail();

        $validated = $request->validate([
            'project_title' => 'sometimes|required|string|max:255',
            'project_description' => 'nullable|string',
            'project_link' => 'nullable|string|url',
        ]);

        $project->update($validated);

        return response()->json([
            'message' => 'Project updated successfully',
            'project' => $project,
        ]);
    }

    /**
     * Delete a project
     */
    public function deleteProject($id)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates can delete projects'], 403);
        }

        $profile = $user->candidateProfile;
        if (!$profile) {
            return response()->json(['error' => 'Profile not found'], 404);
        }

        $project = CandidateProject::where('id', $id)
            ->where('candidate_profile_id', $profile->id)
            ->firstOrFail();

        $project->delete();

        return response()->json([
            'message' => 'Project deleted successfully',
        ]);
    }

    /**
     * Get all skills for authenticated candidate
     */
    public function getSkills()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates have skills'], 403);
        }

        $profile = $user->candidateProfile;
        if (!$profile) {
            return response()->json(['skills' => []]);
        }

        $skills = $profile->skills;

        return response()->json(['skills' => $skills]);
    }

    /**
     * Get all projects for authenticated candidate
     */
    public function getProjects()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if ($user->role !== 'candidate') {
            return response()->json(['error' => 'Only candidates have projects'], 403);
        }

        $profile = $user->candidateProfile;
        if (!$profile) {
            return response()->json(['projects' => []]);
        }

        $projects = $profile->projects;

        return response()->json(['projects' => $projects]);
    }
}
