<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Society;
use Illuminate\Support\Facades\Validator;
use Socket;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'id_card_number' => 'required|string',
            'password' => 'required|string',
        ]);

        $society = Society::query()->with('regional')->where('id_card_number', $request->id_card_number)->first();

        if (!$society || $request->password !== $society->password) {
            return response()->json(['message' => 'ID Card Number or Password incorrect'], 401);
        }

        $society->login_tokens = $society->createToken('authToken')->plainTextToken;
        $society->save();

        $society->token = $society->login_tokens;

        return response()->json($society);
    }

    public function logout(Request $request)
    {
         $token = $request->header('Authorization');
        if (!$token) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        
        return response()->json(['message' => 'Logout success'], 200);
    }
}
