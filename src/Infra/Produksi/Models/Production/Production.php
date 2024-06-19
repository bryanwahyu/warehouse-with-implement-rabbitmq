<?php

namespace Infra\Produksi\Models\Production;

use Infra\Produksi\Models\Product;
use Infra\Shared\Models\BaseModel;

class Production extends BaseModel
{
    public function product()
    {
        return $this->belongsTo(related: Product::class);
    }
}
