<?php

namespace GroceryStore\PreOrderManagement\Requests;

use GroceryStore\PreOrderManagement\Rules\RequestRateLimit;
use Illuminate\Foundation\Http\FormRequest;

class PreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    
    public function messages(): array
    {
        return [
            'product_id' => 'Product is required',
            'email' => 'Email is required',
            'description' => 'Description is required',
            'recaptcha' => 'Recaptcha is required'
        ];
    }
    
    public function rules(): array
    {
        $editMode = $this->input('id');
        
        return [
            'product_id' => ['required'],
            'name' => ['required', new RequestRateLimit],
            'email' => 'required|email',
            'phone' => [
                'sometimes',
                function ($attribute, $value, $fail) {
                    if (!str_ends_with(request('email'), '@gmail.com') && empty($value)) {
                        $fail('The phone field is required if the email is not Gmail.');
                    }
                }
            ],            
            'description' => 'required',
            'recaptcha' => 'required',
        ];
    }
    
    public function fields(): array
    {
        return [
            'product_id' => $this->input('product_id'),
            'name' => $this->input('name'),
            'email' => $this->input('email'),
            'phone' => $this->input('phone'),
            'description' => $this->input('description')
        ];
        
    }
}
