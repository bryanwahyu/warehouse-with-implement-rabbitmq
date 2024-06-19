<?php

namespace Domain\SalesOrder\Actions\Detail;

use Illuminate\Support\Facades\DB;
use Infra\SalesOrder\Model\DetailSalesOrder\DetailSalesOrder;
use Infra\Shared\Foundations\Action;

class DeleteDetailSalesOrderAction extends Action
{
    public function execute(DetailSalesOrder $det)
    {
        DB::beginTransaction();
        $det->delete();
        DB::commit();

        return 1;
    }
}
