<?php

namespace App\Http\Controllers\API\V1\Bahan\Export;

use Domain\Bahan\Actions\Export\CategoryExportAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class CategoryExportController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            return CategoryExportAction::resolve()->execute($req->query());
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
