<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\Supplier;

use Domain\PurchaseOrder\Actions\Supplier\CreateSupplierAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Throwable;

class CreateSupplierController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateSupplierAction::resolve()->execute($req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'data supplier ',
                data: $data
            );
        } catch (Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
