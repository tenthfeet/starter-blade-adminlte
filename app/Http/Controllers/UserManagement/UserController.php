<?php

namespace App\Http\Controllers\UserManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Tenthfeet\Enums\Status;

class UserController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        if ($request->wantsJson()) {
            $data = User::query()
                ->where('id', '>', 1)
                ->get();

            return response()->json(compact('data'));
        }
        $statuses = Status::options();

        return view('pages.user-management.users', compact('statuses'));
    }

    public function store(UserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = new User($validated);
        $user->isd = '91';
        $user->password = 'password#321';
        $user->save();

        $message = 'user saved successfully';

        return response()->json(compact('message'), Response::HTTP_CREATED);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json(compact('user'));
    }

    public function update(User $user, UserRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user->update($validated);

        $message = 'User updated successfully';

        return response()->json(compact('message'));
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        $message = 'User deleted successfully';

        return response()->json(compact('message'));
    }
}
