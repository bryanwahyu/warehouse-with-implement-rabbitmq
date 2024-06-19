<?php

namespace App\Http\Controllers\API\V1\Bahan\Satuan;

use Domain\Bahan\Actions\Satuan\DeleteSatuanAction;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Controllers\BaseController;

class DeleteSatuanController extends BaseController
{
    public function __invoke(Satuan $sat)
    {
        try {
            $data = DeleteSatuanAction::resolve()->execute($sat);

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
