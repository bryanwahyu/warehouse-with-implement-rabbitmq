<?php

namespace App\Http\Controllers\API\V1\Product\Recipe;

use Domain\Product\Actions\Recipe\GetRecipeAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class IndexRecipeController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = GetRecipeAction::resolve()->execute($req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'success',
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
