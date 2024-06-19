<?php

namespace Domain\SalesOrder\Actions\Detail;

use Infra\SalesOrder\Model\DetailSalesOrder\DetailSalesOrder;
use Infra\Shared\Foundations\Action;

class CreateDetailSalesOrderAction extends Action
{
    public function execute($data)
    {
        $detail = DetailSalesOrder::create($data);

        return $detail;
    }
}
