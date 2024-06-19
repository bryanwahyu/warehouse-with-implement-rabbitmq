<?php

namespace Infra\Produksi\Models\Category;

use Infra\Produksi\Models\Product;
use Infra\Shared\Models\BaseModel;

class CategoryProduct extends BaseModel
{
    public function product()
    {
        return $this->hasMany(related: Product::class);
    }
}
