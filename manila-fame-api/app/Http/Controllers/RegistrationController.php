<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Company;

class RegistrationController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // Step 1
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|alpha_num|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'type_of_participation' => 'required|in:Buyer,Exhibitor,Visitor',

            // Step 2
            'company_name' => 'required|string|max:255',
            'address_line' => 'required|string|max:255',
            'town_city' => 'required|string|max:255',
            'region_state' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'year_established' => 'required|digits:4|integer|max:' . now()->year,
            'website' => 'nullable|url',
            'brochure_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error.',
                'errors' => $validator->errors()
            ], 422);
        }

        DB::beginTransaction();

        try {
            // Store user
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'username' => $request->username,
                'type_of_participation' => $request->type_of_participation,
                'password' => Hash::make($request->password),
            ]);

            // Handle file upload
            $brochurePath = null;
            if ($request->hasFile('brochue_file')) {
                $brochurePath = $request->file('brochure_file')->store('brochures', 'public');
            }

            // Store company
            $user->company()->create([
                'company_name' => $request->company_name,
                'address_line' => $request->address_line,
                'town_city' => $request->town_city,
                'region_state' => $request->region_state,
                'country' => $request->country,
                'year_established' => $request->year_established,
                'website' => $request->website,
                'brochure_path' => $brochurePath,
            ]);

            DB::commit();

            return response()->json(['message' => 'Registration successful'], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }
}
