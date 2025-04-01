<?php
namespace App\Http\Controllers\API;
use App\Models\Category;
use App\traits\ResponseJsonTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
class CategoryController extends Controller
{
    use ResponseJsonTrait;
    public function __construct()
    {
        $this->middleware('auth:admins')->only(['store','update','destroy']);
    }
    public function index()
    {
        $categories = Category::all();
        return $this->sendSuccess('Categories Retrieved Successfully!', $categories);
    }
    public function store(CategoryRequest $request)
    {
        $category = Category::create($request->validated());
        return $this->sendSuccess('Category Added Successfully', $category, 201);
    }
    public function show(string $id)
    {
        $category = Category::with('reports')->findOrFail($id);
        return $this->sendSuccess('Category Retrieved Successfully!', $category);
    }
    public function update(CategoryRequest $request,string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->validated());
        return $this->sendSuccess('Category Updated Successfully', $category, 201);
    }
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $this->sendSuccess('Category Deleted Successfully');
    }
}