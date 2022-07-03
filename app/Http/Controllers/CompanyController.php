<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\http\Resources\CompanyResource
     */
    public function index(Request $request)
    {
        $limit = $request->page_size ?? 20;

        $clients = Company::query()
            ->with('clients')
            ->paginate($limit);

        return CompanyResource::collection($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Client $client
     *
     * @return \App\http\Resources\CompanyResource
     */
    public function create(Company $company)
    {
        return CompanyResource::collection($company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\http\Resources\CompanyResource
     */
    public function store(Request $request)
    {
        $created = Company::query()->create([
            'name'            => $request->name,
            'email'           => $request->email,
            'domain'          => $request->domain,
            'primary_phone'   => $request->primary_number,
            'secondary_phone' => $request->secondary_number,
            'address'         => $request->address,
            'description'     => $request->description,
            'logo'            => $request->logo,
        ]);

        return new CompanyResource($created);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     *
     * @return \App\http\Resources\CompanyResource
     */
    public function show($id)
    {
        return Company::query()->with('clients')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Company $company
     *
     * @return \App\http\Resources\CompanyResource
     */
    public function edit(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Company      $company
     *
     * @return \App\http\Resources\CompanyResource
     */
    public function update(Request $request, Company $company)
    {
        $updated = $company->update([
            'name'            => $request->name ?? $company->name,
            'email'           => $request->email ?? $company->email,
            'domain'          => $request->domain ?? $company->domain,
            'primary_phone'   => $request->primary_number ?? $company->primary_number,
            'secondary_phone' => $request->secondary_number ?? $company->secondary_number,
            'address'         => $request->address ?? $company->address,
            'description'     => $request->description ?? $company->description,
            'logo'            => $request->logo ?? $company->logo,
        ]);

        if (!$updated) {
            return new JsonResponse([
                'erros' => 'Failed to updated model.',
            ], 400);
        }

        return new CompanyResource($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Company $company
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Company $company)
    {
        $deleted = $company->forceDelete();

        if (!$deleted) {
            return new JsonResponse([
                'errors' => 'Failed',
            ]);
        }

        return new JsonResponse([
            'status' => 'success',
        ]);
    }
}
