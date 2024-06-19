<?php

namespace Infra\Produksi\Models\Keluar;

use Infra\Produksi\Models\Product;
use Infra\Shared\Models\BaseModel;

class KeluarProduct extends BaseModel
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
