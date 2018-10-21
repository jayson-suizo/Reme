<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class userRegistrationRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'gender' => 'required|in:male,female,other,rather not to say',
            'age' => 'numeric',
            'profession_type' => 'required|numeric',
            'group_type' => 'required|numeric',
            'user_type' => 'required|numeric',
            'role' => 'required|in:admin,client,professional',
            'category' => 'required',
            'group' => 'required|numeric',
        ];
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
