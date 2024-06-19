<?php

namespace App\Http\Controllers\API\V1\SalesOrder\Customer;

use Domain\Customer\Actions\IndexCustomerAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class GetCustomerController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = IndexCustomerAction::resolve()->execute($req->query());
            if ($req->has('page') && $req->has('page_size')) {
                return $this->resolveForSuccessResponseWithPage(
                    message: 'GET CUSTOMER DATA',
                    data: $data
                );
            }

            return $this->resolveForSuccessResponseWith(
                message: 'GET  CUSTOMER DATA',
                data: $data
            );
        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
