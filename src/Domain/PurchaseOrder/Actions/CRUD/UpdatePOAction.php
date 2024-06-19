<?php

namespace Domain\PurchaseOrder\Actions\CRUD;

use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdatePOAction extends Action
{
    public function execute(PurchaseOrder $po, $data)
    {
        if ($po->status == 0) {
            $po->fill($data);
            if ($po->isDirty('code')) {
                $check = PurchaseOrder::where('code', $data['code'])->first();
                if ($check) {
                    throw new BadRequestException('Code PO sudah di buat');
                }
            }

            $po->update($data);

            return $po;
        }
        throw new BadRequestException('Status PO sudah tidak bisa di edit');
    }
}
