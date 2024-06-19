<?php

namespace Infra\Bahan\Models;

use Infra\Bahan\Models\Category\Category;
use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Models\BaseModel;

class Bahan extends BaseModel
{
    public function category()
    {
        return $this->belongsTo(related: Category::class);
    }

    public function satuan()
    {
        return $this->belongsTo(related: Satuan::class);
    }
}
