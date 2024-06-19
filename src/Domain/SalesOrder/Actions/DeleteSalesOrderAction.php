<?php

namespace Domain\SalesOrder\Actions;

use Illuminate\Support\Facades\DB;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Foundations\Action;

class DeleteSalesOrderAction extends Action
{
    public function execute(SalesOrder $sal)
    {
        DB::beginTransaction();
        $sal->delete();
        DB::commit();
    }
}
