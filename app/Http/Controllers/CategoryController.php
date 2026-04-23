<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepo;

    // Inject Repository through Constructor
    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->getAllForUser(auth()->id());
        return view('categories.index', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryRepo->create($request->validated());

        return redirect()->back()->with('success', 'Thêm danh mục thành công!');
    }

    public function destroy($id)
    {
        $this->categoryRepo->delete($id);
        return redirect()->back()->with('success', 'Đã xóa danh mục!');
    }
}
