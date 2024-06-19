<?php

namespace Domain\Product\Actions\Satuan;

use Infra\Produksi\Models\Satuan\SatuanProduct;
use Infra\Shared\Foundations\Action;

class DeleteSatuanProductAction extends Action
{
    public function execute(SatuanProduct $satuan)
    {
        $satuan->delete();

        return true;
    }
}
