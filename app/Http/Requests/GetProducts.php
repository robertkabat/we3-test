<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetProducts extends ApiRequest
{
    public function rules(): array
    {
        return [
            'sku' => 'sometimes|string',
            'name' => 'sometimes|string',
        ];
    }
}
