<?php

namespace App\Http\Controllers\API\V1\Bahan\Keluar;

use Domain\Bahan\Actions\CRUD\Keluar\DeleteKeluarBahanAction;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Keluar\Keluar;
use Infra\Shared\Controllers\BaseController;

class DeleteKeluarController extends BaseController
{
    public function __invoke(Keluar $kel)
    {
        try {
            $data = DeleteKeluarBahanAction::resolve()->execute($kel);

            return $this->resolveForSuccessResponseWith(
                message: 'keluar berhasil keluar',
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
