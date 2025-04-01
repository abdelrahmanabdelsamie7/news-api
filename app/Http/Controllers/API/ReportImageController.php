<?php
namespace App\Http\Controllers\API;

use App\Models\ReportImage;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ReportImageRequest;

class ReportImageController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'destroy']);
    }
    public function store(ReportImageRequest $request)
    {
        $data = $request->validated();
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalName = $image->getClientOriginalName();
                $imageName = time() . '_' . $originalName;
                $image->move(public_path('uploads/reports'), $imageName);
                ReportImage::create([
                    'report_id' => $data['report_id'],
                    'image' => asset('uploads/reports/' . $imageName),
                ]);
            }
        }
        return $this->sendSuccess('Report Images Added Successfully', [], 201);
    }
    public function destroy($id)
    {
        $reportImage = ReportImage::findOrFail($id);
        if ($reportImage->image && !str_contains($reportImage->image, 'default.jpg')) {
            $imageName = basename($reportImage->image);
            $imagePath = public_path("uploads/reports/" . $imageName);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $reportImage->delete();
        return $this->sendSuccess('Report Image Deleted Successfully');
    }
}