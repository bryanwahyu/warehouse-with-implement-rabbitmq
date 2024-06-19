<?php

namespace App\Http\Controllers\API\V1\Product\Satuan;

use Domain\Product\Actions\Satuan\IndexSatuanProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexSatuanProductController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexSatuanProductAction::resolve()->execute($req->query());

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
