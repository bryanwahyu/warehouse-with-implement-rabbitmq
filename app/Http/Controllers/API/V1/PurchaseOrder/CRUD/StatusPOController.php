<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD;

use Domain\PurchaseOrder\Actions\CRUD\ChangeStatusPOAction;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class StatusPOController extends BaseController
{
    public function __invoke(PurchaseOrder $po, $status)
    {
        try {
            $data = ChangeStatusPOAction::resolve()->execute($po, $status);

            return $this->resolveForSuccessResponseWith(
                message: 'PO berhasil di update',
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
