<?php

namespace Domain\PurchaseOrder\Actions\Supplier;

use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Foundations\Action;

class UpdateSupplierAction extends Action
{
    public function execute(Supplier $sup, $data)
    {
        $sup->update($data);

        return $sup;
    }
}
