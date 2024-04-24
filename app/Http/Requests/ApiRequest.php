<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get all the input and files for the request. Also collect data from URL params and query string.
     *
     * @param array|mixed|null $keys
     */
    public function all($keys = null): array
    {
        $data = array_merge(parent::all(), Route::getCurrentRoute()->parameters(), $this->query());
        foreach ($data as $itemKey => $itemValue) {
            match ($itemValue) {
                'true' => $data[$itemKey] = true,
                'false' => $data[$itemKey] = false,
                default => true,
            };
        }

        return $data;
    }
}
