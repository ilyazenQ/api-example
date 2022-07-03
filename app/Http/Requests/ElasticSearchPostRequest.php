<?php

namespace App\Http\Requests;

use App\Support\Requests\BaseFormRequest;

class ElasticSearchPostRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'filter' => ['required', 'array'],
        ];
    }
}

