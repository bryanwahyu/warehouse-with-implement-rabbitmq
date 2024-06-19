<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO;

use Domain\PurchaseOrder\Actions\CRUD\Details\CreateDetailPOAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateDetailPOController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateDetailPOAction::resolve()->execute($req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'berhasil Nambah stok',
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
