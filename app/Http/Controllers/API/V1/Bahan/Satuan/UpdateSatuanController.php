<?php

namespace App\Http\Controllers\API\V1\Bahan\Satuan;

use Domain\Bahan\Actions\Satuan\UpdateSatuanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateSatuanController extends BaseController
{
    public function __invoke(Satuan $sat, Request $req)
    {
        try {
            $data = UpdateSatuanAction::resolve()->execute($sat, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'success get a data category',
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
