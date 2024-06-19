<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD\DetailSalesOrder;

use Domain\SalesOrder\Actions\Detail\CreateDetailSalesOrderAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateDetailSalesOrderController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateDetailSalesOrderAction::resolve()->execute($req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'success',
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
