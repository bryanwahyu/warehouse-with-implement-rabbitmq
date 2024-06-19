<?php

namespace App\Http\Controllers\API\V1\History\Stok;

use Domain\History\Actions\GetHistoryStokAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class GetHistoryController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = GetHistoryStokAction::resolve()->execute($req);

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
