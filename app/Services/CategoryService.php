<?php
namespace App\Services;

use App\Models\Laundry;

class CategoryService
{
    protected $categoryModel;

    function __construct()
    {
        $this->categoryModel = new Laundry();
    }

    /**
     * Category list function
     *
     * @return array
     */
    public function list(): ?array
    {
        return $this->categoryModel
            ->where("status", 1)
            ->with('types')
            ->get()
                ?->toArray() ?? [];
    }

    public function store(array $data = []): int
    {
        return $this->categoryModel->create($data);
    }
}