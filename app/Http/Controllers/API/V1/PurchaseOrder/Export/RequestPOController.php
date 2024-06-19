<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\Export;

use Domain\PurchaseOrder\Actions\Export\RequestPOAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Controllers\BaseController;

class RequestPOController extends BaseController
{
    public function __invoke(PurchaseOrder $po, Request $req)
    {
        try {
            return RequestPOAction::resolve()->execute($po, $req->query());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
