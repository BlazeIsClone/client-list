<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->query("limit");

        if (empty($limit)) {
            $data = Company::query()
                ->with("clients")
                ->paginate($limit);
        } else {
            $data = Company::query()
                ->with("clients")
                ->paginate(50);
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
            "name" => "",
            "email" => "",
            "domain" => "",
            "primary_phone" => "",
            "secondary_phone" => "",
            "address" => "",
            "description" => "",
            "logo" => "",
        ];

        return new JsonResponse(
            [
                "data" => $create
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $created = Company::query()->create([
            "name" => $request->name,
            "email" => $request->email,
            "domain" => $request->domain,
            "primary_phone" => $request->primary_number,
            "secondary_phone" => $request->secondary_number,
            "address" => $request->address,
            "description" => $request->description,
            "logo" => $request->logo,
        ]);

        return new JsonResponse(
            [
                "data" => $created
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Company $company)
    {
        return new JsonResponse(
            [
                "data" => $company->with("clients")->get()
            ]
        );
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
            "name" => $request->name,
            "email" => $request->email,
            "domain" => $request->domain,
            "primary_phone" => $request->primary_number,
            "secondary_phone" => $request->secondary_number,
            "address" => $request->address,
            "description" => $request->description,
            "logo" => $request->logo,
        ];

        Company::where("id", $id)
            ->update($payload);

        return new JsonResponse($payload);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Company $company)
    {
        $updated = $company
            ->update(
                [
                    "name" =>
                    $request->name ?? $company->name,
                    "email" =>
                    $request->email ?? $company->email,
                    "domain" =>
                    $request->domain ?? $company->domain,
                    "primary_phone" =>
                    $request->primary_number ?? $company->primary_number,
                    "secondary_phone" =>
                    $request->secondary_number ?? $company->secondary_number,
                    "address" =>
                    $request->address ?? $company->address,
                    "description" =>
                    $request->description ?? $company->description,
                    "logo" =>
                    $request->logo ?? $company->logo,
                ]
            );

        if (!$updated) {
            return new JsonResponse(
                [
                    "erros" => "Failed to updated model.",
                ],
                400
            );
        }

        return new JsonResponse([
            "data" => $updated,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company $company
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Company $company)
    {
        $deleted = $company->forceDelete();

        if (!$deleted) {
            return new JsonResponse([
                "errors" => "Failed",
            ]);
        }
        return new JsonResponse([
            "status" => "success",
        ]);
    }
}
