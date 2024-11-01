<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Validation;
use Illuminate\Support\Facades\Auth;

class ValidationController extends Controller
{

    public function requestValidation(Request $request)
    {
        $request->validate([
            'work_experience' => 'required|string',
            'job_category_id' => 'required|integer',
            'job_position' => 'required|string',
            'reason_accepted' => 'required|string',
        ]);

        $validation = Validation::create([
            'society_id' => Auth::id(),
            'status' => 'pending',
            'work_experience' => $request->work_experience,
            'job_category_id' => $request->job_category_id, 
            'job_position' => $request->job_position,
            'reason_accepted' => $request->reason_accepted,
        ]);

        return response()->json([
            'message' => 'Request data validation sent successfully'
        ], 200);
    }


    
    public function getValidation()
    {
        $validation = Validation::where('society_id', Auth::id())->get();

        if (!$validation) {
            return response()->json(['message' => 'No validation data found'], 404);
        }

        return response()->json([
            'validation' => [
                $validation
            ]
        ], 200);
    }
}
