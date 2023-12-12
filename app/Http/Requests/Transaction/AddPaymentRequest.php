<?php

namespace App\Http\Requests\Transaction;

use App\Modules\EnumManager\Enums\UserTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class AddPaymentRequest extends FormRequest
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
            'paid_on' => 'required',
            'details' => 'sometimes',
        ];
    }
}
