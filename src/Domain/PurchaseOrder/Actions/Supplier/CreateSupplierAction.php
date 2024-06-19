<?php

namespace Domain\PurchaseOrder\Actions\Supplier;

use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Foundations\Action;

class CreateSupplierAction extends Action
{
    public function execute($data)
    {
        return Supplier::create($data);
    }
}
