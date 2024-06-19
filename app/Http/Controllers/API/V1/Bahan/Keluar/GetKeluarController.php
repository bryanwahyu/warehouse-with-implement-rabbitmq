<?php

namespace App\Http\Controllers\API\V1\Bahan\Keluar;

use Domain\Bahan\Actions\CRUD\Keluar\GetKeluarBahanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class GetKeluarController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = GetKeluarBahanAction::resolve()->execute($req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'Get data',
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
