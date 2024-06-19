<?php

namespace Domain\PurchaseOrder\Actions\CRUD\Details;

use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\Shared\Foundations\Action;

class DeleteDetailPOAction extends Action
{
    public function execute(DetailPurchaseOrder $det)
    {

        $det->delete();
    }
}
