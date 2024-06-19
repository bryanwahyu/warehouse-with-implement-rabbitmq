<?php

namespace Domain\SalesOrder\Actions;

use Domain\SalesOrder\Actions\Detail\CreateDetailSalesOrderAction;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Foundations\Action;

class CreateSalesOrderAction extends Action
{
    public function execute($data)
    {
        $data['status_payment'] = 'Unpaid';
        if (Arr::exists($data, 'details')) {
            $detail = $data['details'];
            $data = Arr::except($data, 'details');
        }
        DB::beginTransaction();

        $sales = SalesOrder::create($data);
        if ($detail) {
            $this->handleDetail($detail, $sales);
        }
        DB::commit();

        return $sales;
    }

    protected function handleDetail($detail, SalesOrder $sales)
    {
        foreach ($detail as $data) {
            $data = Arr::except($data, 'sequence');
            $data['sales_order_id'] = $sales->id;
            $test = CreateDetailSalesOrderAction::resolve()->execute($data);
        }
    }
}
