<?php
namespace App\Http\Controllers\API;
use App\Models\Report;
use App\Mail\NewsAdded;
use App\Models\Subscriber;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReportRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class ReportController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $reports = Report::with('category')->get();
        return $this->sendSuccess('All Reports Retrieved Successfully!', $reports);
    }
    public function store(ReportRequest $request)
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

        $report = Report::create($data);

        // جلب الإيميلات
        $subscribers = Subscriber::pluck('email')->toArray();

        // إرسال الإيميل فقط إذا كان هناك مشتركين
        if (!empty($subscribers)) {
            Mail::to($subscribers)->send(new NewsAdded($report));
            return $this->sendSuccess('Report Added Successfully & Emails Sent!', $report, 201);
        }

        return $this->sendSuccess('Report Added Successfully (No Subscribers to Email)', $report, 201);
    }
    public function show(string $id)
    {
        $report = Report::with(['category:id,title', 'author:id,name,image', 'images'])->findOrFail($id);
        return $this->sendSuccess('Report Retrieved Successfully!', $report);
    }
    public function update(ReportRequest $request, string $id)
    {
        $report = Report::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $oldImagePath = public_path('uploads/reports/' . basename($report->image));
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $originalName = $request->image->getClientOriginalName();
            $imageName = time() . '_' . $originalName;
            $request->image->move(public_path('uploads/reports'), $imageName);
            $data['image'] = asset('uploads/reports/' . $imageName);
        }
        $report->update($data);
        return $this->sendSuccess('Report Data Updated Successfully', $report, 200);
    }
    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        if ($report->image && !str_contains($report->image, 'default.jpg')) {
            $imageName = basename($report->image);
            $imagePath = public_path("uploads/reports/" . $imageName);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $report->delete();
        return $this->sendSuccess('Report Deleted Successfully');
    }
}
