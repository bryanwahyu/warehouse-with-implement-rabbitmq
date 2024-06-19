<?php

namespace Infra\Produksi\Models;

use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Produksi\Models\Recipe\Recipe;
use Infra\Produksi\Models\Satuan\SatuanProduct;
use Infra\Shared\Models\BaseModel;

class Product extends BaseModel
{
    public function satuan()
    {
        return $this->belongsTo(related: SatuanProduct::class, foreignKey: 'satuan_product_id');
    }

    public function category()
    {
        return $this->belongsTo(related: CategoryProduct::class, foreignKey: 'category_product_id');
    }

    public function recipe()
    {
        return $this->hasMany(related: Recipe::class);
    }
}
