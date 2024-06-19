<?php

namespace Domain\PurchaseOrder\Actions\CRUD;

use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ChangeStatusPOAction extends Action
{
    public function execute(PurchaseOrder $po, $status)
    {
        $methodName = 'changeTo'.ucfirst($status);

        if (! method_exists($this, $methodName)) {
            throw new BadRequestException('Status salah');
        }
        $this->$methodName($po);

        return $po;
    }

    protected function changeToRejection(PurchaseOrder $po)
    {
        if ($po->status == 7 || $po->status == 2) {
            throw new BadRequestException('status tidak bisa diganti');
        }
        $po->status = 2;
        $po->save();
    }

    protected function changeToRequest(PurchaseOrder $po)
    {
        if ($po->status != 1) {
            throw new BadRequestException('status tidak bisa di ganti');
        }
        $po->status = 3;
        $po->save();
    }

    protected function changeToApproval(PurchaseOrder $po)
    {
        if ($po->status != 0) {
            throw new BadRequestException('status tidak bisa diganti');
        }
        $po->status = 1;
        $po->save();
    }

    protected function changeToSend(PurchaseOrder $po)
    {
        if ($po->status != 3) {
            throw new BadRequestException('status tidak bisa diganti');
        }
        $po->status = 4;
        $po->save();
    }

    protected function changeToCheck(PurchaseOrder $po)
    {
        if ($po->status != 4) {
            throw new BadRequestException('status tidak bisa diganti');
        }
        $po->status = 5;
        $po->save();
    }

    protected function changeToClose(PurchaseOrder $po)
    {

        if ($po->status != 5) {
            throw new BadRequestException('status tidak bisa di ganti');
        }
        if ($po->unchecked_detail()->count() > 0) {
            throw new BadRequestException('ada barang belum dicheck');
        }

        $po->status = 6;
        $po->save();
    }

    protected function changeToCompleted(PurchaseOrder $po)
    {
        if ($po->status != 6) {
            throw new BadRequestException('status tidak bisa di ganti');
        }
        $po->status = 7;
        $po->save();
    }
}
