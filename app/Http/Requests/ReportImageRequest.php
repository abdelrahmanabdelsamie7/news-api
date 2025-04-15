<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ReportImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'report_id' => 'required|exists:reports,id',
            'images' => 'required|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4048'
        ];
    }
}