<?php

namespace Domain\PurchaseOrder\Actions\CRUD;

use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeletePOAction extends Action
{
    public function execute(PurchaseOrder $po)
    {
        if (! $this->checkStatus($po)) {
            throw new BadRequestException('tidak bisa delete');
        }
        $po->delete();

        return true;
    }

    public function checkStatus($po)
    {
        if ($po->status > 3) {
            return false;
        }

        return true;
    }
}
