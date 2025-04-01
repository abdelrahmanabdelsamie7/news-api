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
        $this->middleware('auth:admins')->only(['store','destroy']);
    }
    public function store(ReportImageRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $imageName = time() . '_' . $originalName;
            $request->file('image')->move(public_path('uploads/reports'), $imageName);
            $data['image'] = asset('uploads/reports/' . $imageName);
        } else {
            $data['image'] = null;
        }
        $reportImage = ReportImage::create($data);
        return $this->sendSuccess('Report Image Added Successfully', $reportImage, 201);
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
