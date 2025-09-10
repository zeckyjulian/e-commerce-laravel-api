<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Auth::user();

        if ($user->id != $id) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized access.',
            ], 403);
        }

        return response()->json([
            'status' => true,
            'message' => 'Profile data successfully showed.',
            'data' => $user->profile,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'phone' => 'nullable|string|max:20',
            'shipping_address' => 'nullable|string|max:255',
            'gender' => 'nullable|in:M,F',
            'date_of_birth' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            $data['photo'] = $photoPath;
        } else {
            unset($data['photo']);
        }

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return response()->json([
            'status' => true,
            'message' => 'Profile updated successfully',
            'data' => $profile,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
