<?php

namespace App\Http\Controllers\API\V1\SalesOrder\CRUD;

use Domain\SalesOrder\Actions\EditSalesOrderAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Controllers\BaseController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateSalesOrderController extends BaseController
{
    public function __invoke(SalesOrder $sal, Request $req)
    {
        try {
            $data = EditSalesOrderAction::resolve()->execute($sal, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'Sales Edited',
                data: $data
            );
        } catch (BadRequestException $th) {
            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
