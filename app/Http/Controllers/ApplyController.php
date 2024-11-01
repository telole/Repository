<?php namespace App\Http\Controllers;

use App\Models\Apply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ApplyController extends Controller
{
    public function applyForJob(Request $request)
{
    $validator = Validator::make($request->all(), [
        'vacancy_id' => 'required|integer',
        'positions' => 'required|array', 
        'society_id' => 'required|integer',
        'notes' => 'string|nullable',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Invalid field',
            'errors' => $validator->errors(),
        ], 422);
    }

    if ($this->hasApplied($request->society_id, $request->vacancy_id)) {
        return response()->json(['message' => 'Application for a job can only be once'], 401);
    }

    foreach ($request->positions as $position) {
        Apply::create([
            'job_vacancy_id' => $request->vacancy_id,
            'position_id' => $position, 
            'society_id' => $request->society_id,
            'notes' => $request->notes,
            'status' => 'pending',
            'date' => Carbon::now(),
        ]);
    }

    return response()->json(['message' => 'Applying for job successful'], 200);
}


    public function getAllApplications(Request $request)
    {
        if (!$this->isTokenValid($request->token)) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        $applications = Apply::where('society_id', $request->society_id)->get();

        return response()->json(['vacancies' => $applications], 200);
    }

    private function isTokenValid($token)
    {
        return true; 
    }

    private function hasApplied($society_id, $job_vacancy_id)
    {
        return Apply::where('society_id', $society_id)
                    ->where('job_vacancy_id', $job_vacancy_id)
                    ->exists();
    }
}
