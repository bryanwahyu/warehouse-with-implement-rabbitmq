<?php

namespace App\Http\Controllers\API\V1\Product\Masuk;

use Domain\Product\Actions\CRUD\Masuk\DeleteMasukProductAction;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Masuk\MasukProduct;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeleteMasukProductController extends BaseController
{
    public function __invoke(MasukProduct $mas)
    {

        try {
            $data = DeleteMasukProductAction::resolve()->execute($mas);

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
