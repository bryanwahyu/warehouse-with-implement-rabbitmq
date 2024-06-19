<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrder;

use Domain\SalesOrder\Actions\Detail\DetailDetailSalesOrderAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\DetailSalesOrder\DetailSalesOrder;
use Infra\Shared\Controllers\BaseController;

class DetailDetailSalesOrderController extends BaseController
{
    public function __invoke(Request $req, DetailSalesOrder $det)
    {
        try {
            $data = DetailDetailSalesOrderAction::resolve()->execute($det, $req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'detail detail data',
                data: $data
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
