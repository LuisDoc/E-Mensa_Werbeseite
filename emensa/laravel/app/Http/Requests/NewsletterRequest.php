<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\DomainRules;
class NewsletterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    protected $redirect = '/#newsletter';

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|regex:/^[a-zA-Z]+$/u|max:50',
            'email'=>['required','unique:newsletter', new DomainRules()],
            'language'=>'required',
        ];
    }
}
