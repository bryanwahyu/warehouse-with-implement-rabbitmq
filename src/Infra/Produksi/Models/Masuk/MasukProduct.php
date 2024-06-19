<?php

namespace Infra\Produksi\Models\Masuk;

use Infra\Produksi\Models\Product;
use Infra\Shared\Models\BaseModel;

class MasukProduct extends BaseModel
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
