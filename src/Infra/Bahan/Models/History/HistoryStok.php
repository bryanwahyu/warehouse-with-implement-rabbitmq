<?php

namespace Infra\Bahan\Models\History;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Models\BaseModel;

class HistoryStok extends BaseModel
{
    public function bahan()
    {
        return $this->belongsTo(related: Bahan::class);
    }
}
