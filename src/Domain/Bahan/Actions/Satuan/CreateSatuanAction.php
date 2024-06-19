<?php

namespace Domain\Bahan\Actions\Satuan;

use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Foundations\Action;

class CreateSatuanAction extends Action
{
    public function execute($data)
    {
        $sat = Satuan::create($data);

        return $sat;
    }
}
