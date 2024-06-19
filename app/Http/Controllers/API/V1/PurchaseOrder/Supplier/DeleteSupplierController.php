<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\Supplier;

use Domain\PurchaseOrder\Actions\Supplier\DeleteSupplierAction;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Controllers\BaseController;

class DeleteSupplierController extends BaseController
{
    public function __invoke(Supplier $sup)
    {
        try {
            $data = DeleteSupplierAction::resolve()->execute($sup);

            return $this->resolveForSuccessResponseWith(
                message: 'Delete sukses',
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
