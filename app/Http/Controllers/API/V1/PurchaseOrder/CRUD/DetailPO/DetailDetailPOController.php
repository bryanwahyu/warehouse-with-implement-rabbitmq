<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO;

use Domain\PurchaseOrder\Actions\CRUD\Details\DetailDetailPOAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\Shared\Controllers\BaseController;

class DetailDetailPOController extends BaseController
{
    public function __invoke(DetailPurchaseOrder $det, Request $req)
    {
        try {
            $data = DetailDetailPOAction::resolve()->execute($det, $req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'data berhasil',
                data: $data
            );
        } catch (\Throwable $th) {
            Log::info($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
