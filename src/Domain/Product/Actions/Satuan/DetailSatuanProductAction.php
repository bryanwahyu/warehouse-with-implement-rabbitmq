<?php

namespace Domain\Product\Actions\Satuan;

use Infra\Produksi\Models\Satuan\SatuanProduct;
use Infra\Shared\Foundations\Action;

class DetailSatuanProductAction extends Action
{
    protected $sat;

    public function execute(SatuanProduct $satuan, $query)
    {
        $this->sat = $satuan;

        return $this->sat;
    }
}
