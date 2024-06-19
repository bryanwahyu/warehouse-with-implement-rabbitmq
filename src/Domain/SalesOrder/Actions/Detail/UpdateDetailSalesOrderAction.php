<?php

namespace Domain\SalesOrder\Actions\Detail;

use Illuminate\Support\Facades\DB;
use Infra\SalesOrder\Model\DetailSalesOrder\DetailSalesOrder;
use Infra\Shared\Foundations\Action;

class UpdateDetailSalesOrderAction extends Action
{
    public function execute(DetailSalesOrder $det, $data)
    {
        DB::beginTransaction();
        $det->update($data);
        DB::commit();

        return $det;

    }
}
