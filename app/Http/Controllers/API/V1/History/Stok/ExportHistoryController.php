<?php

namespace App\Http\Controllers\API\V1\History\Stok;

use Domain\History\Actions\ExportHistoryStokAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class ExportHistoryController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            return ExportHistoryStokAction::resolve()->execute($req->query());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
