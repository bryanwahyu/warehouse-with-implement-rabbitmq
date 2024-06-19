<?php

namespace App\Http\Controllers\API\V1\Product\Satuan;

use Domain\Product\Actions\Satuan\DetailSatuanProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Satuan\SatuanProduct;
use Infra\Shared\Controllers\BaseController;

class DetailSatuanProductController extends BaseController
{
    public function __invoke(SatuanProduct $sat, Request $req)
    {
        try {
            $data = DetailSatuanProductAction::resolve()->execute($sat, $req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'success get a data category',
                data: $data
            );
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
