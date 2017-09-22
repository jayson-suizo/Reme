<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class manageUserSubscriptionRequest extends FormRequest
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
        switch ($this->method()) {
            case 'POST':{
                return [
                    'user_id' => 'required',
                    'subscription_id' => 'required',
                ];
            }
            break;
            case 'PUT':{
                return [
                   'user_id' => 'required',
                   'subscription_id' => 'required',
                ];

            }
            break;
        }    
    }


     /**
     * Get the failed validation response for the request.
     *
     * @param array $errors
     * @return JsonResponse
     */
    public function response(array $errors)
    {
        $transformed = [];
        foreach ($errors as $field => $message) {
            $transformed[] = [
                'field' => $field,
                'message' => $message[0]
            ];
        }

        return response()->json([
            'errors' => $transformed
        ]);
    }
}
