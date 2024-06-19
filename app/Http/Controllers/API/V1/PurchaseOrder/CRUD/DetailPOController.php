<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD;

use Domain\PurchaseOrder\Actions\CRUD\DetailsPOAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Controllers\BaseController;

class DetailPOController extends BaseController
{
    public function __invoke(Request $req, PurchaseOrder $po)
    {
        try {
            $data = DetailsPOAction::resolve()->execute($po, $req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'get detail po',
                data: $data
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage(),
            );
        }
    }
}
