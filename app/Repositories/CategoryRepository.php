<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        $title = trans('main.categories');
        $categories = Category::all();
        return view('admin.categories.index', compact('title', 'categories'));
    }

    public function storeCategory($request)
    {
        try {
            $data['name'] = $request->name;
            Category::create($data);

            toastr()->success(trans('messages.success'));
            return back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function updateCategory($request)
    {
        $id = $request->id;
        try {
            $category = Category::findOrFail($id);
            $data['name'] = $request->name;
            $category->update($data);

            toastr()->warning(trans('messages.update'));
            return back();

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['errors' => $e->getMessage()]);
        }
    }

    public function deleteCategory($request)
    {
        Category::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.delete'));
        return back();
    }
}
