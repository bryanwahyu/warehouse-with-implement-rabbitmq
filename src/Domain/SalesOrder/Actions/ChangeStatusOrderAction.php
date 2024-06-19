<?php

namespace Domain\SalesOrder\Actions;

use Illuminate\Support\Facades\DB;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ChangeStatusOrderAction extends Action
{
    public function execute(SalesOrder $sal, $status, $payment, $data = [])
    {
        $methodName = 'changeTo'.ucfirst($status).ucfirst($payment);
        if (! method_exists($this, $methodName)) {
            throw new BadRequestException('Status salah atau payment salah');
        }
        DB::beginTransaction();
        if ($methodName == '') {

        }
        $this->$methodName($sal);
        DB::commit();

        return $sal;
    }

    protected function changeToApprovedPaid(SalesOrder $sal)
    {
        if ($sal->status != 'Approved' && $sal->status_payment == 'Unpaid') {
            throw new BadRequestException('Status tidak bisa diganti');
        }
        $sal->status = 'Approved';
        $sal->status_payment = 'Paid';
        $sal->save();
    }

    protected function changeToRefundRefund(SalesOrder $sal)
    {
        if ($sal->status_payment != 'Paid') {
            throw new BadRequestException('Tidak bisa melakukan Refund');
        }
        $sal->status = 'Refund';
        $sal->status_payment = 'Refund';
        $sal->save();
    }

    protected function changeToApprovedUnpaid(SalesOrder $sal)
    {
        if ($sal->status != 'Order') {
            throw new BadRequestException('Tidak bisa dicancel');
        }
        $sal->status = 'Approved';
        $sal->save();
    }

    protected function changeToRejectedUnpaid(SalesOrder $sal)
    {
        if ($sal->status != 'Order') {
            throw new BadRequestException('Tidak bisa melakukan rejected');
        }
        $sal->status = 'Canceled';
        $sal->status_payment = 'Canceled';
        $sal->save();
    }

    protected function changeToDeliveryPaid(SalesOrder $sal)
    {
        if ($sal->status != 'Approved' && $sal->status_payment != 'Paid') {
            throw new BadRequestException('Status salah');
        }

        $sal->status = 'Delivery';

        $sal->save();
    }

    protected function changeToCompletedPaid(SalesOrder $sal)
    {
        if ($sal->status != 'Delivery' && $sal->status_payment != 'Paid') {
            throw new BadRequestException('Status salah');
        }
        $sal->status = 'Completed';
        $sal->save();
    }

    protected function changeToClosePaid(SalesOrder $sal)
    {
        if ($sal->status != 'Completed') {
            throw new BadRequestException('status completed belum selesai');
        }
        $sal->status = 'Closed';
        $sal->save();
    }

    protected function changeToCloseRefund(SalesOrder $sal)
    {
        if ($sal->status != 'Refund') {
            throw new BadRequestException('Status Tidak bisa Refund');
        }
        $sal->status = 'Closed';
        $sal->save();
    }
}
