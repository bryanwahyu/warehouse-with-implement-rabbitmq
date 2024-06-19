<?php

namespace App\Http\Controllers\API\V1\Product\Production;

use Domain\Produksi\Actions\GetProduksiAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexProductionController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = GetProduksiAction::resolve()->execute($req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'ggg',
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
