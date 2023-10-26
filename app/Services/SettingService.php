<?php
namespace App\Services;

use App\Models\Cloths;
use App\Models\Laundry;
use App\Models\Types;

class SettingService
{
    protected $typesModel;
    protected $categoriesModel;
    protected $subCategoriesModel;

    function __construct()
    {
        $this->typesModel = new Types();
        $this->categoriesModel = new Laundry();
        $this->subCategoriesModel = new Cloths();
    }
    public function types()
    {
        return $this->typesModel->select('name')->get();
    }

    public function categories()
    {
        return $this->categoriesModel->select('name')->get();
    }

    public function subCategories()
    {
        return $this->subCategoriesModel->select('name')->get();
    }
}