<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return $this->categoryRepository->getAllCategories();
    }

    public function store(Request $request)
    {
        $rules = ['name' => 'required|unique:categories'];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم التنصيف',
            'name.unique' => 'اسم التنصيف مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->categoryRepository->storeCategory($request);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $rules = ['name' => 'required|unique:categories,name,' . $id];
        $validate_msg = [
            'name.required' => 'يجب كتابه اسم التنصيف',
            'name.unique' => 'اسم التنصيف مسجل مسبقا',
        ];
        $data = $this->validate($request, $rules, $validate_msg);

        return $this->categoryRepository->updateCategory($request);
    }

    public function destroy(Request $request)
    {
        return $this->categoryRepository->deleteCategory($request);
    }
}
