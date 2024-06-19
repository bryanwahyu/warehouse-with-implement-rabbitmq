<?php

namespace Infra\Produksi\Models\Recipe;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Models\BaseModel;

class Recipe extends BaseModel
{
    public function bahan()
    {
        return $this->belongsTo(related: Bahan::class, foreignKey: 'bahan_id');
    }
}
