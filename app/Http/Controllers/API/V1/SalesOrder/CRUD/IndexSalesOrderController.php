<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD;

use Domain\SalesOrder\Actions\IndexSalesOrderAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexSalesOrderController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexSalesOrderAction::resolve()->execute($req->query());
            if ($req->has('page') && $req->has('page_size')) {
                return $this->resolveForSuccessResponseWithPage(
                    message: 'Data Sales Orders',
                    data: $data
                );
            }

            return $this->resolveForSuccessResponseWith(
                message: 'Data Sales Orders',
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
