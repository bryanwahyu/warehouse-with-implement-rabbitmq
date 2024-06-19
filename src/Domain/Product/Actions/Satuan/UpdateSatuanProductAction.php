<?php

namespace Domain\Product\Actions\Satuan;

use Infra\Produksi\Models\Satuan\SatuanProduct;
use Infra\Shared\Foundations\Action;

class UpdateSatuanProductAction extends Action
{
    public function execute(SatuanProduct $sat, $data)
    {
        $sat->fill($data);
        $sat->save();

        return $sat;
    }
}
