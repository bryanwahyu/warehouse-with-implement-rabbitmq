<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrder;

use Domain\SalesOrder\Actions\Detail\UpdateDetailSalesOrderAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\DetailSalesOrder\DetailSalesOrder;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateDetailSalesOrderController extends BaseController
{
    public function __invoke(Request $req, DetailSalesOrder $det)
    {
        try {
            $data = UpdateDetailSalesOrderAction::resolve()->execute($det, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'Update detail',
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
