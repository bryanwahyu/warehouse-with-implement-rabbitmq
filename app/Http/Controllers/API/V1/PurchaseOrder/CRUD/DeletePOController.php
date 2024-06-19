<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD;

use Domain\PurchaseOrder\Actions\CRUD\DeletePOAction;
use Illuminate\Support\Facades\Log;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Throwable;

class DeletePOController extends BaseController
{
    public function __invoke(PurchaseOrder $po)
    {
        try {
            $data = DeletePOAction::resolve()->execute($po);

            return $this->resolveForSuccessResponseWith(
                message: 'Delete success po',
            );
        } catch (BadRequestException $th) {
            return $this->resolveForFailedResponseWith(
                message: $th->getMessage(),
                status: HttpStatus::BadRequest
            );
        } catch (Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
