<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->query('limit');

        if (empty($limit)) {
            $data = Client::query()->with('company')->paginate($limit);
        } else {
            $data = Client::query()->with('company')->paginate(50);
        }

        return new JsonResponse($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $create = [
            'email' => '',
            'first_name' => '',
            'last_name' => '',
            'primary_phone' => '',
            'secondary_phone' => '',
            'timezone' => '',
            'company_id' => '',
        ];

        return new JsonResponse(['data' => $create]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $created = Client::query()->create([
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'primary_phone' => $request->primary_number,
            'secondary_phone' => $request->secondary_number,
            'timezone' => $request->timezone,
            'company_id' => $request->company_id,
        ]);

        return new JsonResponse(['data' => $created]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Client $client)
    {
        return new JsonResponse(['data' => $client->query()->with('company')->get()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        $payload = [
            'email' => $request->email,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'primary_phone' => $request->primary_number,
            'secondary_phone' => $request->secondary_number,
            'timezone' => $request->timezone,
            'company_id' => $request->company_id,
        ];

        Client::where('id', $id)->update($payload);

        return new JsonResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client $client
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Client $client)
    {

        $updated = $client->update([
            'email' => $request->email ?? $client->email,
            'first_name' => $request->first_name ?? $client->first_name,
            'last_name' => $request->last_name ?? $client->last_name,
            'primary_phone' => $request->primary_number ?? $client->primary_number,
            'secondary_phone' => $request->secondary_number ?? $client->secondary_number,
            'timezone' => $request->timezone ?? $client->timezone,
            'company_id' => $request->company_id ?? $client->company_id,
        ]);

        if (!$updated) {
            return new JsonResponse([
                'erros' => 'Failed to updated model.',
            ], 400);
        }

        return new JsonResponse([
            'data' => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $deleted = $client->forceDelete();

        if (!$deleted) {
            return new JsonResponse([
                'errors' => 'Failed'
            ]);
        }
        return new JsonResponse([
            'status' => 'success',
        ]);
    }
}
