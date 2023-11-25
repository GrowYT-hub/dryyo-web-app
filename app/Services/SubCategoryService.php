<?php
namespace App\Services;

use App\Models\Cloths;

class SubCategoryService
{
    protected $subCategoryModel;

    function __construct()
    {
        $this->subCategoryModel = new Cloths();
    }

    /**
     * Category list function
     *
     * @return array
     */
    public function list(int $category_id = null): ?array
    {
        $subCategories = $this->subCategoryModel
            ->where("status", 1)
            ->with('categories');

        if ($category_id) {
            $subCategories = $subCategories->where('category_id', $category_id);
        }
        $subCategories = $subCategories->get()
                ?->toArray() ?? [];

        return $subCategories;
    }

    public function subCategory(int $subCategoryId = null)
    {
        return $this->subCategoryModel->find($subCategoryId)?->toArray();
    }
}