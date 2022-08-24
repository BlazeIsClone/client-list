<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Show the form for creating a new user.
     *
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function create(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Store a newly created user in storage.
     *
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function store(Request $request): UserResource
    {
        $created = User::query()->create([
            'uuid' => $request->uuid,
        ]);

        return new UserResource($created);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function edit(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified user in storage.
     *
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function update(Request $request, User $user): UserResource | JsonResponse
    {
        $updated = $user->update([
            'uuid' => $request->uuid ?? $user->uuid,
        ]);

        if (! $updated) {
            return new JsonResponse([
                'erros' => 'Failed to updated model.',
            ], 400);
        }

        return new UserResource($updated);
    }

    /**
     * Remove the specified user from storage.
     *
     * @apiResource App\Http\Resources\UserResource
     * @apiResourceModel App\Models\User
     */
    public function destroy(User $user): JsonResponse
    {
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
