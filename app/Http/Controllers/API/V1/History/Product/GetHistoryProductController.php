<?php

namespace App\Http\Controllers\API\V1\History\Product;

use Domain\Product\Actions\History\GetHistoryProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class GetHistoryProductController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = GetHistoryProductAction::resolve()->execute($req);

            return $this->resolveForSuccessResponseWith(
                message: 'Success get data',
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
