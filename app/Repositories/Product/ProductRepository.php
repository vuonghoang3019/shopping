<?php

namespace App\Repositories\Product;

use App\Components\Recursive;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\BaseRepository;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function getModel()
    {
        return Product::class;
    }

    public function getProduct()
    {
        return $this->model->paginate(5);
    }

    public function getCategory($parent_id)
    {
        $categories = Category::all();
        $recursive = new Recursive($categories);
        $htmlOption =  $recursive->categoryRecursive($parent_id);
        return $htmlOption;
    }


}
