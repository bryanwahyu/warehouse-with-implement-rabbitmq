<?php

namespace App\Http\Controllers\API\V1\Bahan\CRUD;

use Domain\Bahan\Actions\CRUD\DetailBahanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Controllers\BaseController;

class DetailBahanController extends BaseController
{
    public function __invoke(Bahan $bah, Request $req)
    {
        try {
            $data = DetailBahanAction::resolve()->execute($bah, $req->query());

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
