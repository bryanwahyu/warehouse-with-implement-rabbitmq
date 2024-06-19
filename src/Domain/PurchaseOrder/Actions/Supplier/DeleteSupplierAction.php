<?php

namespace Domain\PurchaseOrder\Actions\Supplier;

use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Foundations\Action;

class DeleteSupplierAction extends Action
{
    public function execute(Supplier $sup)
    {
        $sup->delete();

        return $sup;

    }
}
