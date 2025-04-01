<?php
namespace App\Http\Controllers\API;
use App\Models\Author;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use Illuminate\Support\Facades\File;

class AuthorController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $authors = Author::all();
        return $this->sendSuccess('All Authors Retrieved Successfully!', $authors);
    }
    public function store(AuthorRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $imageName = time() . '_' . $originalName;
            $request->file('image')->move(public_path('uploads/authors'), $imageName);
            $data['image'] = asset('uploads/authors/' . $imageName);
        } else {
            $data['image'] = null;
        }
        $author = Author::create($data);
        return $this->sendSuccess('Author Added Successfully', $author, 201);
    }
    public function show(string $id)
    {
        $author = Author::with('reports')->findOrFail($id);
        return $this->sendSuccess('Author Retrieved Successfully!', $author);
    }
    public function update(AuthorRequest $request, string $id)
    {
        $author = Author::findOrFail($id);
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $oldImagePath = public_path('uploads/authors/' . basename($author->image));
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
            $originalName = $request->image->getClientOriginalName();
            $imageName = time() . '_' . $originalName;
            $request->image->move(public_path('uploads/authors'), $imageName);
            $data['image'] = asset('uploads/authors/' . $imageName);
        }
        $author->update($data);
        return $this->sendSuccess('Author Data Updated Successfully', $author, 200);
    }
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        if ($author->image && !str_contains($author->image, 'default.jpg')) {
            $imageName = basename($author->image);
            $imagePath = public_path("uploads/authors/" . $imageName);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        $author->delete();
        return $this->sendSuccess('Author Removed Successfully');
    }
}
