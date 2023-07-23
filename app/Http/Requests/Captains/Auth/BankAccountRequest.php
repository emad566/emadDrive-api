<?php

namespace App\Http\Requests\Captains\Auth;

use Illuminate\Validation\Rule;
use App\Http\Requests\APIRequest;

class BankAccountRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            'account_name' => ['required','max:25'],
            'iban_number' => ['required', 'regex:/[E]{1}[G]{1}[0-9]{22}/'],
            'account_number' => ['required'],
            'bank_name' => ['required_with:account_number'],
        ];
    }

    public function messages()
    {
        // use trans instead on Lang
        return [
            'iban_number.regex' => __('The IBAN Must EG and 22 digit'),
        ];
    }
}
