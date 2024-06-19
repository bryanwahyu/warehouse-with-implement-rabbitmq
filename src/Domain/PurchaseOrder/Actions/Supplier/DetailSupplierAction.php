<?php

namespace Domain\PurchaseOrder\Actions\Supplier;

use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Foundations\Action;

class DetailSupplierAction extends Action
{
    protected $sup;

    public function execute(Supplier $sup, $query)
    {
        $this->sup = $sup;

        return $sup;

    }
}
