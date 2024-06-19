<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO;

use Domain\PurchaseOrder\Actions\CRUD\Details\UpdateDetailPOAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateDetailPOController extends BaseController
{
    public function __invoke(DetailPurchaseOrder $det, Request $req)
    {
        try {
            $data = UpdateDetailPOAction::resolve()->execute($det, $req->all());

            return $this->resolveForSuccessResponseWith(
                data: $data,
                message: 'data berhasil diupdate'
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
