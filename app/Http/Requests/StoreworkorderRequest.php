<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreworkorderRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           
            'user_id'=>'integer',
            'jobname'=>'required',
            'jobnumber'=>'',
            'no_small_format'=>'string|max:255',
            'sm1orig'=>'integer|max:3000',
            'sm1copy'=>'integer|max:3000',
            'sm1size' => 'string|max:255',
            'sm1colorsides' => 'string|max:255',
            'sm1scale' => 'string|max:255',
            'sm1binding' => 'string|max:255',
            'sm1description' => 'max:55',
            'sm2orig'=>'integer|max:3000',
            'sm2copy'=>'integer|max:3000',
            'sm2size' => 'string|max:255',
            'sm2colorsides' => 'string|max:255',
            'sm2scale' => 'string|max:255',
            'sm2binding' => 'string|max:255',
            'sm2description' => 'max:55',
            'lg1orig'=>'integer|max:3000',
            'lg1copy'=>'integer|max:3000',
            'lg1size' => 'string|max:255',
            'lg1colorsides' => 'string|max:255',
            'lg1scale' => 'string|max:255',
            'lg1binding' => 'string|max:255',
            'lg1description' => 'max:55',
            'lg2orig'=>'integer|max:3000',
            'lg2copy'=>'integer|max:3000',
            'lg2size' => 'string|max:255',
            'lg2colorsides' => 'string|max:255',
            'lg2scale' => 'string|max:255',
            'lg2binding' => 'string|max:255',
            'lg2description' => 'max:55',
            'turnaround'=>'string|max:255',
            'delivery'=>'required|max:255',
            'alt_address'=>'max:60',
            'specialinstructions'=>'max:175',
        ];
    }
}
