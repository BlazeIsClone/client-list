<?php

namespace App\Http\Requests;

use App\Rules\StringArray;
use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'name'              => ['string', 'unique:companies,name'],
            'email'             => ['email', 'unique:companies,email'],
            'domain'            => ['string', 'unique:companies,domain'],
            'primary_phone'     => ['string'],
            'secondary_phone'   => ['string'],
            'address'           => ['string'],
            'description'       => ['string'],
            'logo'              => ['string'],
            'user_id'           => ['string', 'required'],
            'client_ids'        => ['array', new StringArray()],
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
