<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\Supplier;

use Domain\PurchaseOrder\Actions\Supplier\UpdateSupplierAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Controllers\BaseController;

class UpdateSupplierController extends BaseController
{
    public function __invoke(Supplier $sup, Request $req)
    {
        try {
            $data = UpdateSupplierAction::resolve()->execute($sup, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'update berhasil',
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
