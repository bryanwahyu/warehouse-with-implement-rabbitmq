<?php

namespace App\Http\Controllers\API\V1\Bahan\Masuk;

use Domain\Bahan\Actions\CRUD\Masuk\DeleteMasukBahanAction;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Masuk\Masuk;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeleteMasukController extends BaseController
{
    public function __invoke(Masuk $mas)
    {
        try {
            $data = DeleteMasukBahanAction::resolve()->execute($mas);

            return $this->resolveForSuccessResponseWith(
                message: 'Delete success'
            );
        } catch (BadRequestException $th) {
            Log::error($th->getMessage());

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
