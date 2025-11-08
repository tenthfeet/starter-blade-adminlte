<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(Request $request): View
    {
        $user = $request->user();

        return view('pages.user-management.profile', compact('user'));
    }

    public function update(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'mobile_no' => ['required', 'numeric', 'digits:10'],
        ]);

        $user = $request->user();
        $user->update($validated);
        $message = 'Profile details updated successfully !';

        return response()->json(compact('message'));
    }
}
