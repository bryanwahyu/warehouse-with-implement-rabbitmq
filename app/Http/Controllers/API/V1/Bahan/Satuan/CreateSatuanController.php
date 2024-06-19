<?php

namespace App\Http\Controllers\API\V1\Bahan\Satuan;

use Domain\Bahan\Actions\Satuan\CreateSatuanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class CreateSatuanController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateSatuanAction::resolve()->execute($req->all());

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
