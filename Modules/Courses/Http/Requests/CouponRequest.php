<?php

namespace Coupons\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
        $rules = [
            'brand_id'      => 'bail|required|integer',
            'type'          => 'bail|required|in:percentage,fixed',
            'amount'        => 'bail|required|numeric',
            'usage'         => 'bail|required|in:one_time,multi_times',
            'user_usage'    => 'bail|required|in:one_time,multi_times',
            'expires_at'    => 'bail|required|date'
        ];

        if (request()->usage == 'one_time') {
            $rules['multi_times_count'] = 'bail|required|numeric|in:1';
        }

        if (request()->usage == 'multi_times') {
            $rules['multi_times_count'] = 'bail|required|numeric|not_in:0,1';
        }

        if (request()->method() == 'POST') {
            $rules['code'] = 'bail|required|unique:coupons,code';
        } else {
            $id = request()->coupon;
            $rules['code'] = 'bail|required|unique:coupons,code,'.$id;
        }

        return $rules;
    }
}
