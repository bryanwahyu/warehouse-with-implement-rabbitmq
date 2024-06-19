<?php

namespace Domain\SalesOrder\Actions;

use Illuminate\Support\Facades\DB;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class EditSalesOrderAction extends Action
{
    public function execute(SalesOrder $sal, $data)
    {
        DB::beginTransaction();
        if ($sal->status == 'Closed' || $sal->status == 'Delivery' || $sal->status_payment == 'Paid' || $sal->status_payment == 'Cancelled' || $sal->status_payment == 'Refund') {
            throw new BadRequestException('tidak bisa ganti pesanan');
        }
        $sal->update($data);
        DB::commit();

        return $sal;
    }
}
