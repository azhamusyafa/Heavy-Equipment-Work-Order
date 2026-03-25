<?php

namespace App\Http\Requests\WorkshopLocation;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkshopLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'site_code'     => 'required|string|max:20|unique:master_workshop_locations,site_code',
            'location_name' => 'required|string|max:150',
            'address'       => 'required|string',
        ];
    }
}