<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use App\Models\AvailablePosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobVacancyController extends Controller
{

    public function getJobVacancies(Request $request)
    {
       
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

      
        $jobCategoryId = $request->query('job_category_id');

       
        $vacancies = JobVacancy::with(['category', 'availablePositions'])
                        ->when($jobCategoryId, function ($query) use ($jobCategoryId) {
                            $query->where('job_category_id', $jobCategoryId);
                        })
                        ->get();

        return response()->json(['vacancies' => $vacancies], 200);
    }

   
    public function getJobVacancyDetail($id)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized user'], 401);
        }

        $vacancy = JobVacancy::with(['category', 'availablePositions'])->find($id);

        if (!$vacancy) {
            return response()->json(['message' => 'Job vacancy not found'], 404);
        }

        return response()->json(['vacancy' => $vacancy], 200);
    }
}
