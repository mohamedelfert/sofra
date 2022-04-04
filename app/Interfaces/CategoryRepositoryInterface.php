<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategories();

    public function storeCategory($request);

    public function updateCategory($request);

    public function deleteCategory($request);
}
