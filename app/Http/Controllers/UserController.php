<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * @group User Management
 *
 * API to manage the user resource.
 */
class UserController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct(User $user)
    {
        $this->authorizeResource($user::class);
    }

    /**
     * Display authenticated user.
     *
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function index(): UserResource
    {
        $users = auth()->user();

        return new UserResource($users);
    }


    /**
     * Remove the specified user from storage.
     *
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function destroy(User $user): JsonResponse
    {
        dd($user);
        $deleted = $user->forceDelete();

        if (! $deleted) {
            return new JsonResponse([
                'errors' => 'Failed',
            ]);
        }

        return new JsonResponse([
            'status' => 'success',
        ]);
    }
}
