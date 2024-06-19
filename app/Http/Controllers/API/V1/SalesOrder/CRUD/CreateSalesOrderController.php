<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD;

use Domain\SalesOrder\Actions\CreateSalesOrderAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class CreateSalesOrderController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateSalesOrderAction::resolve()->execute($req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'Success create Data',
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
