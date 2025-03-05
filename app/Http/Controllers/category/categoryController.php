<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use App\Service\category\categoryService;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    // categoryService instance
    protected $category;

    // Constructor to bind categoryService instance
    public function __construct(categoryService $category)
    {
        $this->category = $category;
    }

    // Get all categories from the database Start ********************************
    public function getCategory(Request $request)
    {
        return $this->category->getCategory($request);
    }

    // Get all categories from the database End ********************************
    // Add new category to the database Start ********************************
    public function addCategory(Request $request)
    {
        return $this->category->addCategory($request);
    }

    // Add new category to the database End ********************************
    // Update category to the database Start ********************************
    public function updateCategory(Request $request)
    {
        return $this->category->updateCategory($request);
    }

    // Update category to the database End ********************************
    // Delete category from the database Start ********************************
    public function deleteCategory(Request $request)
    {
        return $this->category->deleteCategory($request);
    }
    // Delete category from the database End ********************************
}
