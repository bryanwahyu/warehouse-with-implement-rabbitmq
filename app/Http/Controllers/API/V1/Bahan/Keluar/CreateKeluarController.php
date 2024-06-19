<?php

namespace App\Http\Controllers\API\V1\Bahan\Keluar;

use Domain\Bahan\Actions\CRUD\Keluar\CreateKeluarBahanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateKeluarController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateKeluarBahanAction::resolve()->execute($req->bahan_id, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'Keluar bahan berhasil',
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
