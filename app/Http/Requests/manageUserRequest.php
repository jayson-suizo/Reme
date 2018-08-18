<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class manageUserRequest extends FormRequest
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
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required',
                    'c_password' => 'required|same:password',
                    'gender' => 'required|in:male,female,other,rather not to say',
                    'birth_date' => 'required|date:Y-m-d',
                    'profession_type' => 'required|numeric',
                    'group_type' => 'required|numeric',
                    'user_type' => 'required|numeric',
                    'role' => 'required|in:admin,customer',
                ];
            }
            break;
            case 'PUT':{
                return [
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email',
                    'gender' => 'required|in:male,female,other,rather not to say',
                    'birth_date' => 'required|date:Y-m-d',
                    'group_type' => 'required|numeric',
                    'user_type' => 'required|numeric',
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
