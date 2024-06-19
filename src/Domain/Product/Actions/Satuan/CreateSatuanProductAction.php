<?php

namespace Domain\Product\Actions\Satuan;

use Infra\Produksi\Models\Satuan\SatuanProduct;
use Infra\Shared\Foundations\Action;

class CreateSatuanProductAction extends Action
{
    public function execute($data)
    {
        $sat = SatuanProduct::create($data);

        return $sat;
    }
}
