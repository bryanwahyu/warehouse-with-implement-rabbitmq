<?php

namespace App\Http\Controllers\API\V1\Bahan\Satuan;

use Domain\Bahan\Actions\Satuan\IndexSatuanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexSatuanController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexSatuanAction::resolve()->execute($req->query());

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
