<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\Supplier;

use Domain\PurchaseOrder\Actions\Supplier\IndexSupplierAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexSupplierController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexSupplierAction::resolve()->execute($req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'Get data',
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
