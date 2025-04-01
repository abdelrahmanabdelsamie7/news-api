<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ShareIdeaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
            'reply' => 'nullable|string',
            'report_id' => 'required|exists:reports,id',
        ];
    }
}