<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoveRequest extends FormRequest
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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $this->dd(234);
        return [
            'action' => ['required']
        ];
    }

    /**
     * @return string
     */
    public function getAction(): string
    {
        return $this->input('action');
    }
}
