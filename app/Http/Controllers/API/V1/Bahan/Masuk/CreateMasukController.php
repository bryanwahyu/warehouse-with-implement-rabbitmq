<?php

namespace App\Http\Controllers\API\V1\Bahan\Masuk;

use Domain\Bahan\Actions\CRUD\Masuk\CreateMasukBahanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateMasukController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateMasukBahanAction::resolve()->execute($req->bahan_id, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'Create Masuk berhasil',
                data: $data
            );
        } catch (BadRequestException $th) {
            Log::info($th->getMessage());

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
