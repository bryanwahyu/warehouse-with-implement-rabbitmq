<?php

namespace App\Http\Controllers\API\V1\Bahan\CRUD;

use Domain\Bahan\Actions\CRUD\DeleteBahanAction;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Controllers\BaseController;

class DeleteBahanController extends BaseController
{
    public function __invoke(Bahan $bah)
    {
        try {
            $data = DeleteBahanAction::resolve()->execute($bah);

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
