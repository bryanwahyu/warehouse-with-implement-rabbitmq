<?php

namespace App\Http\Controllers\API\V1\Bahan\Category;

use Domain\Bahan\Actions\Category\DeleteCategoryAction;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Category\Category;
use Infra\Shared\Controllers\BaseController;

class DeleteCategoryController extends BaseController
{
    public function __invoke(Category $cat)
    {
        try {
            $data = DeleteCategoryAction::resolve()->execute($cat);

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
