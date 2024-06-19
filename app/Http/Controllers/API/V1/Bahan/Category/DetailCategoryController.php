<?php

namespace App\Http\Controllers\API\V1\Bahan\Category;

use Domain\Bahan\Actions\Category\DetailCategoryAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Category\Category;
use Infra\Shared\Controllers\BaseController;

class DetailCategoryController extends BaseController
{
    public function __invoke(Category $cat, Request $req)
    {
        try {
            $data = DetailCategoryAction::resolve()->execute($cat, $req->query());

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
