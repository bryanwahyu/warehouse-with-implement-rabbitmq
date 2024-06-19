<?php

namespace App\Http\Controllers\API\V1\Product\Category;

use Domain\Product\Actions\Category\DetailCategoryProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DetailCategoryProductController extends BaseController
{
    public function __invoke(CategoryProduct $cat, Request $req)
    {
        try {
            $data = DetailCategoryProductAction::resolve()->execute($cat, $req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'delete berhasil',
                data: $data
            );
        } catch (BadRequestException $th) {
            return $this->resolveForFailedResponseWith(
                message: $th->getMessage(),
                status: HttpStatus::BadRequest
            );
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}