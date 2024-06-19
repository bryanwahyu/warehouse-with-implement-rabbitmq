<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD\DetailPO;

use Domain\PurchaseOrder\Actions\CRUD\Details\DeleteDetailPOAction;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\Details\DetailPurchaseOrder;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeleteDetailPOController extends BaseController
{
    public function __invoke(DetailPurchaseOrder $det)
    {
        try {
            $data = DeleteDetailPOAction::resolve()->execute($det);

            return $this->resolveForSuccessResponseWith(
                message: 'Po berhasil di hapus '
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
