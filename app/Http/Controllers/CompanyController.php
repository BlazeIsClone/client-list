<?php

namespace App\Http\Controllers;

use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * @group Company Mangement
 *
 * API to manage company resource.
 */
class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     *
     * @param  \Illuminate\Http\Request  $request
     * @queryParam page_size int Size per page. Defaults to 20.
     * @queryParam page int int Page to view.
     */
    public function index(Request $request): ResourceCollection
    {
        $limit = $request->page_size ?? 20;

        $clients = Company::query()
            ->with('clients')
            ->paginate($limit);

        return CompanyResource::collection($clients);
    }

    /**
     * Show the form for creating a new company.
     *
     * @param  \App\Models\Client  $client
     */
    public function create(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Store a newly created company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request): CompanyResource
    {
        $created = Company::query()->create([
            'name' => $request->name,
            'email' => $request->email,
            'domain' => $request->domain,
            'primary_phone' => $request->primary_number,
            'secondary_phone' => $request->secondary_number,
            'address' => $request->address,
            'description' => $request->description,
            'logo' => $request->logo,
        ]);

        return new CompanyResource($created);
    }

    /**
     * Display the specified company.
     *
     * @param $id
     */
    public function show($id): Company
    {
        return Company::query()->with('clients')->find($id);
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param  \App\Models\Company  $company
     */
    public function edit(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified company in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     */
    public function update(Request $request, Company $company): CompanyResource | JsonResponse
    {
        $updated = $company->update([
            'name' => $request->name ?? $company->name,
            'email' => $request->email ?? $company->email,
            'domain' => $request->domain ?? $company->domain,
            'primary_phone' => $request->primary_number ?? $company->primary_number,
            'secondary_phone' => $request->secondary_number ?? $company->secondary_number,
            'address' => $request->address ?? $company->address,
            'description' => $request->description ?? $company->description,
            'logo' => $request->logo ?? $company->logo,
        ]);

        if (! $updated) {
            return new JsonResponse([
                'erros' => 'Failed to updated model.',
            ], 400);
        }

        return new CompanyResource($updated);
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  \App\Models\Company  $company
     */
    public function destroy(Company $company): JsonResponse
    {
        $deleted = $company->forceDelete();

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
