<?php

namespace Infra\Produksi\Models\History;

use Infra\Produksi\Models\Product;
use Infra\Shared\Models\BaseModel;

class HistoryProduct extends BaseModel
{
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
