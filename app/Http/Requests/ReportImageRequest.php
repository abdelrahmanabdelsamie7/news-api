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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
        ];
    }
}
