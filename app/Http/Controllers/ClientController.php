<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\http\Controllers\ClientController
     */
    public function index(Request $request)
    {
        $limit = $request->page_size ?? 20;

        $clients = Client::query()
            ->with('company')
            ->paginate($limit);

        return ClientResource::collection($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Client $client
     *
     * @return \App\http\Controllers\ClientController
     */
    public function create(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\http\Controllers\ClientController
     */
    public function store(Request $request)
    {
        $created = Client::query()->create([
            'email'           => $request->email,
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'primary_phone'   => $request->primary_phone,
            'secondary_phone' => $request->secondary_phone,
            'timezone'        => $request->timezone,
            'company_id'      => $request->company_id,
        ]);

        return new ClientResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Client $client
     *
     * @return \App\http\Controllers\ClientController
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Client $client
     *
     * @return \App\http\Controllers\ClientController
     */
    public function edit(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Client       $client
     *
     * @return \App\http\Controllers\ClientController | JsonResponse
     */
    public function update(Request $request, Client $client)
    {
        $updated = $client->update([
            'email'           => $request->email ?? $client->email,
            'first_name'      => $request->first_name ?? $client->first_name,
            'last_name'       => $request->last_name ?? $client->last_name,
            'primary_phone'   => $request->primary_number ?? $client->primary_number,
            'secondary_phone' => $request->secondary_number ?? $client->secondary_number,
            'timezone'        => $request->timezone ?? $client->timezone,
            'company_id'      => $request->company_id ?? $client->company_id,
        ]);

        if (! $updated) {
            return new JsonResponse([
                'erros' => 'Failed to updated model.',
            ], 400);
        }

        return new ClientResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $deleted = $client->forceDelete();

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
