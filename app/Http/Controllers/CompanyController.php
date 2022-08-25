<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use App\Traits\UserClaims;
use Illuminate\Database\Eloquent\Builder;
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
    use UserClaims;

    /**
     * Create the controller instance.
     */
    public function __construct(Company $company)
    {
        $this->authorizeResource($company::class);
    }

    /**
     * Display a listing of the companies.
     *
     * @queryParam page_size int Size per page. Defaults to 20.
     * @queryParam page int int Page to view.
     * @apiResourceCollection App\Http\Resources\CompanyResource
     * @apiResourceModel App\Models\Company
     */
    public function index(Request $request): ResourceCollection
    {
        $limit = $request->page_size ?? 20;

        $clients = Company::query()
            ->with('clients')
             ->whereHas('user', function (Builder $query) {
                 return $query->where('uuid', $this->getUserUUID());
             })->paginate($limit);

        return CompanyResource::collection($clients);
    }

    /**
     * Show the form for creating a new company.
     *
     * @apiResource App\Http\Resources\CompanyResource
     * @apiResourceModel App\Models\Company
     */
    public function create(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Store a newly created company in storage.
     *
     * @apiResource App\Http\Resources\CompanyResource
     * @apiResourceModel App\Models\Company
     */
    public function store(StoreCompanyRequest $request): CompanyResource
    {
        $created = Company::create($request->getAttributes());

        return new CompanyResource($created);
    }

    /**
     * Display the specified company.
     *
     * @apiResource App\Http\Resources\CompanyResource
     * @apiResourceModel App\Models\Company
     */
    public function show(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Show the form for editing the specified company.
     *
     * @apiResource App\Http\Resources\CompanyResource
     * @apiResourceModel App\Models\Company
     */
    public function edit(Company $company): CompanyResource
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified company in storage.
     *
     * @apiResource App\Http\Resources\CompanyResource
     * @apiResourceModel App\Models\Company
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
     * @apiResource App\Http\Resources\CompanyResource
     * @apiResourceModel App\Models\Company
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
