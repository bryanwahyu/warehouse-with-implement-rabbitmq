<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD;

use Domain\SalesOrder\Actions\DeleteSalesOrderAction;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeleteSalesOrderController extends BaseController
{
    public function __invoke(SalesOrder $sal)
    {
        try {
            $data = DeleteSalesOrderAction::resolve()->execute($sal);

            return $this->resolveForSuccessResponseWith(
                message: 'Success Deleted Sales Order'
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
