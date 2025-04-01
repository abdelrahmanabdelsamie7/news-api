<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class AuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
        ];
    }
}
