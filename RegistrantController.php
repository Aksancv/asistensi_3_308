<?php

namespace App\Http\Controllers;

use App\Models\Registrant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegistrantController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:registrants,email',
            'phone' => 'required|string|max:15',
            'class' => 'required|string|max:50',
            'motivation' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $registrant = Registrant::create($request->all());
        return response()->json(['message' => 'Registration successful', 'data' => $registrant], 201);
    }

    public function index()
    {
        $registrants = Registrant::all();
        return response()->json(['data' => $registrants], 200);
    }
}