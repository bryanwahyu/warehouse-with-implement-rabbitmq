<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD;

use Domain\PurchaseOrder\Actions\CRUD\IndexPOAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexPOController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexPOAction::resolve()->execute($req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'Get a Data',
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
