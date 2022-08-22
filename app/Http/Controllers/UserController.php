<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

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
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Display a listing of users.
     */
    public function index(Request $request): ResourceCollection
    {
        $users = User::query()
            ->get();

        return UserResource::collection($users);
    }

    /**
     * Show the form for creating a new user.
     *
     * @param  \App\Models\User  $user
     */
    public function create(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request): UserResource
    {
        $created = User::query()->create([
            'uuid' => $request->uuid,
        ]);

        return new UserResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     */
    public function show(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User  $user
     */
    public function edit(User $user): UserResource
    {
        return new UserResource($user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
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
     * @param  \App\Models\User  $user
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
