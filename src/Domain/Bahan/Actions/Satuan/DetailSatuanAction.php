<?php

namespace Domain\Bahan\Actions\Satuan;

use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Foundations\Action;

class DetailSatuanAction extends Action
{
    protected $sat;

    public function execute(Satuan $satuan, $query)
    {
        $this->sat = $satuan;

        return $this->sat;
    }
}
