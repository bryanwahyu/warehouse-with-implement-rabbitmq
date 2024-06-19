<?php

namespace Infra\Bahan\Models\Category;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Models\BaseModel;

class Category extends BaseModel
{
    public function bahan()
    {
        return $this->hasMany(related: Bahan::class);
    }
}
