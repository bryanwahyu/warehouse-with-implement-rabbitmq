<?php

namespace App\Http\Controllers\API\V1\Bahan\Export;

use Domain\Bahan\Actions\Export\StokOpnameExportAction;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class StokOpnameExportController extends BaseController
{
    public function __invoke()
    {
        try {
            return StokOpnameExportAction::resolve()->execute();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->GetMessage()
            );

        }
    }
}
