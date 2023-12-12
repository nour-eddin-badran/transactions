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
            'user_id' => 'required',
            'due_on' => 'required',
            'vat' => 'required',
            'is_vat_inclusive' => 'required',
        ];
    }
}
