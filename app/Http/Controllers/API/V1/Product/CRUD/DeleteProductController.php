<?php

namespace App\Http\Controllers\API\V1\Product\CRUD;

use Domain\Product\Actions\CRUD\DeleteProductAction;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Product;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeleteProductController extends BaseController
{
    public function __invoke(Product $prod)
    {
        try {
            $data = DeleteProductAction::resolve()->execute($prod);

            return $this->resolveForSuccessResponseWith(
                message: 'success data',
                data: $data
            );
        } catch (BadRequestException $th) {
            return $this->resolveForFailedResponseWith(
                message: $th->getMessage(),
                status: HttpStatus::BadRequest
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
