<?php

namespace App\Http\Controllers\API\V1\Product\Production;

use Domain\Produksi\Actions\UpdateProduksiAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Controllers\BaseController;

class UpdateProductionController extends BaseController
{
    public function __invoke(Request $req, Production $prod)
    {
        try {
            $data = UpdateProduksiAction::resolve()->execute($prod, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'gg',
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
