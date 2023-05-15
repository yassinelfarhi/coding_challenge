<?php

namespace App\Repositories ;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function createCategory(array $data){

        return Category::create($data);

    }

    public function updateCategory($id, array $data)
    {
        $Category = Category::findOrFail($id);
        $Category->update($data);
        return $Category;
    }

    public function deleteCategory($id)
    {
        $Category = Category::findOrFail($id);
        $Category->delete();
    }

    
}
