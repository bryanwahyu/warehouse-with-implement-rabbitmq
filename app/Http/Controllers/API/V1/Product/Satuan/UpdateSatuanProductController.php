<?php

namespace App\Http\Controllers\API\V1\Product\Satuan;

use Domain\Product\Actions\Satuan\UpdateSatuanProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Satuan\SatuanProduct;
use Infra\Shared\Controllers\BaseController;

class UpdateSatuanProductController extends BaseController
{
    public function __invoke(SatuanProduct $sat, Request $req)
    {
        try {
            $data = UpdateSatuanProductAction::resolve()->execute($sat, $req->all());

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
