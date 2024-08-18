<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function updateLocation(Request $request): JsonResponse
    {
        $request->validate([
            'location' => 'required|string|max:255',
        ]);

        $user = auth()->user();
        $user->location = $request->location;
        $user->save();

        return response()->json($user, 200);
    }
}
