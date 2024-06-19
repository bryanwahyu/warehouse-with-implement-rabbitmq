<?php

namespace App\Http\Controllers\API\V1\Bahan\CRUD;

use Domain\Bahan\Actions\CRUD\IndexBahanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexBahanController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexBahanAction::resolve()->execute($req);

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
