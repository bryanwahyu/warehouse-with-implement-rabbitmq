<?php

namespace App\Http\Controllers\API\V1\Product\Category;

use Domain\Product\Actions\Category\IndexCategoryProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class IndexCategoryProductController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexCategoryProductAction::resolve()->execute($req);

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
