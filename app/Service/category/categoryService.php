<?php

namespace App\Service\category;

use App\Helper\ResponseHelper;
use App\Models\Category;
use Exception;

class categoryService
{
    // Get all categories from the database Start ********************************
    public function getCategory()
    {
        try {
            $categoryList = Category::all();

            return ResponseHelper::Out(true, $categoryList, 200);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Failed to get categories', 500);
        }
    }
    // Get all categories from the database End ********************************

    // Add new category to the database Start ********************************
    public function addCategory($request)
    {
        try {
            $userRole = $request->header('role');
            $categoryName = $request->input('categoryName');
            $categoryImg = $request->input('categoryImg');
            if ($userRole === 'admin' || $userRole === 'superadmin') {
                Category::updateOrCreate(
                    ['categoryName' => $request->input('categoryName')], // Unique condition
                    ['categoryImg' => $request->input('categoryImg')] // Data to insert/update
                );

                return ResponseHelper::Out(true, 'Category Created Successfully', 200);
            }

            return ResponseHelper::Out(false, 'unauthorized', 403);
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Category Creation Failed', 500);
        }

    }
    // Add new category to the database End ********************************

    // Update category to the database Start ********************************
    public function updateCategory($request)
    {
        try {
            $userRole = $request->header('role');
            $categoryId = $request->categoryId;
            $categoryName = $request->input('categoryName');
            $categoryImg = $request->input('categoryImg');
            if ($userRole === 'admin' || $userRole === 'superadmin') {
                Category::where('id', $categoryId)->update(['categoryName' => $categoryName, 'categoryImg' => $categoryImg]);

                return ResponseHelper::Out(true, 'Category Updated Successfully', 200);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Category Update Failed', 500);
        }
    }
    //  Update category to the database End ********************************

    // Delete category from the database Start ********************************
    public function deleteCategory($request)
    {
        try {
            $userRole = $request->header('role');
            $categoryId = $request->categoryId;
            if ($userRole === 'admin' || $userRole === 'superadmin') {
                Category::where('id', $categoryId)->delete();

                return ResponseHelper::Out(true, 'Category Deleted Successfully', 200);
            }
        } catch (Exception $e) {
            return ResponseHelper::Out(false, 'Category Deletion Failed', 500);
        }
    }
    // Delete category from the database End ********************************
}
