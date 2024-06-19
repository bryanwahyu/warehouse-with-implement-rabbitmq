<?php

namespace Infra\Bahan\Models\Masuk;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Models\BaseModel;

class Masuk extends BaseModel
{
    public function bahan()
    {
        return $this->belongsTo(related: Bahan::class);
    }
}
