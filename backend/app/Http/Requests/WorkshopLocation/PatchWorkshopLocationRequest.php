<?php

namespace App\Http\Requests\WorkshopLocation;

use Illuminate\Foundation\Http\FormRequest;

class PatchWorkshopLocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('workshop_location');

        return [
            'site_code'     => "sometimes|string|max:20|unique:master_workshop_locations,site_code,{$id}",
            'location_name' => 'sometimes|string|max:150',
            'address'       => 'sometimes|string',
        ];
    }
}