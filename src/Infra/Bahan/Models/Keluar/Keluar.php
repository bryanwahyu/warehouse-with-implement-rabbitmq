<?php

namespace Infra\Bahan\Models\Keluar;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Models\BaseModel;

class Keluar extends BaseModel
{
    public function bahan()
    {
        return $this->belongsTo(related: Bahan::class);
    }
}
