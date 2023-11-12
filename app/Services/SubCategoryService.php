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
    public function list(): ?array
    {
        return $this->subCategoryModel
            ->where("status", 1)
            ->with('categories')
            ->get()
                ?->toArray() ?? [];
    }
}