<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD;

use Domain\SalesOrder\Actions\ChangeStatusOrderAction;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ChangeStatusSalesOrderController extends BaseController
{
    public function __invoke(SalesOrder $sal, $status, $payment)
    {
        try {
            $data = ChangeStatusOrderAction::resolve()->execute($sal, $status, $payment);

            return $this->resolveForSuccessResponseWith(
                message: 'Success change status',
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
