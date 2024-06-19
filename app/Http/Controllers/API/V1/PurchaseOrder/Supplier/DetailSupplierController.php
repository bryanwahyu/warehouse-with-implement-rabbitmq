<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\Supplier;

use Domain\PurchaseOrder\Actions\Supplier\DetailSupplierAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Controllers\BaseController;
use Throwable;

class DetailSupplierController extends BaseController
{
    public function __invoke(Supplier $sup, Request $req)
    {
        try {
            $data = DetailSupplierAction::resolve()->execute($sup, $req->query());

            return $this->resolveForSuccessResponseWith(
                data: $data,
                message: 'Get a detail data'
            );

        } catch (Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
