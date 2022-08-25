<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'email'             => ['required', 'email', 'unique:clients,email'],
            'first_name'        => ['required'],
            'last_name'         => ['string'],
            'avatar'            => ['url'],
            'title'             => ['string'],
            'primary_phone'     => ['string'],
            'secondary_phone'   => ['string'],
            'job_title'         => ['string'],
            'timezone'          => ['string'],
            'company_id'        => ['string'],
            'user_id'           => ['string', 'required'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'user_id' => (string) auth()->user()->id,
        ]);
    }

    /**
     * Get all validated attributes
     */
    public function getAttributes(): array
    {
        return array_merge(
            $this->safe()->all()
        );
    }
}
