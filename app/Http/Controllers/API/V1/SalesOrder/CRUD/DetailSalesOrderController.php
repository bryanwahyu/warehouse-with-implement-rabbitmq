<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD;

use Domain\SalesOrder\Actions\DetailSalesOrderAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Controllers\BaseController;

class DetailSalesOrderController extends BaseController
{
    public function __invoke(SalesOrder $sal, Request $req)
    {
        try {
            $data = DetailSalesOrderAction::resolve()->execute($sal, $req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'get detail SO',
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
