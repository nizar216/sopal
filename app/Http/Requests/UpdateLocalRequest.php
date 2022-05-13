<?php

namespace App\Http\Requests;

use App\Local;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateLocalRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('local_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }
}
