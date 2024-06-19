<?php

namespace App\Http\Controllers\API\V1\Product\Recipe;

use Domain\Product\Actions\Recipe\UpdateRecipeAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Recipe\Recipe;
use Infra\Shared\Controllers\BaseController;

class UpdateRecipeController extends BaseController
{
    public function __invoke(Recipe $res, Request $req)
    {
        try {
            $data = UpdateRecipeAction::resolve()->execute($res, $req->all());

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
