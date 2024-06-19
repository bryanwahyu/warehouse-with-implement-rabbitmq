<?php

namespace App\Http\Controllers\API\V1\Bahan\Satuan;

use Domain\Bahan\Actions\Satuan\DetailSatuanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Controllers\BaseController;

class DetailSatuanController extends BaseController
{
    public function __invoke(Satuan $sat, Request $req)
    {
        try {
            $data = DetailSatuanAction::resolve()->execute($sat, $req->query());

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
