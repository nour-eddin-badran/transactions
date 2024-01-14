<?php

namespace App\Http\Requests\Transaction;

use App\Modules\EnumManager\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class AddTransactionRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount' => 'required',
            'user_id' => ['required', 'exists:users,id'],
            'due_on' => 'required',
            'vat' => Rule::requiredIf(fn() => \request()->get('is_vat_inclusive') == "false"),
            'is_vat_inclusive' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'vat.required' => __('messages.vat_is_required')
        ];
    }
}
