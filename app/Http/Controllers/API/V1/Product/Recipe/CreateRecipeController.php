<?php

namespace App\Http\Controllers\API\V1\Product\Recipe;

use Domain\Product\Actions\Recipe\CreateRecipeAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class CreateRecipeController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateRecipeAction::resolve()->execute($req->all());

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
