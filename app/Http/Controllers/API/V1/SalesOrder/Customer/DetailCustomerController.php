<?php

namespace App\Http\Controllers\API\V1\SalesOrder\Customer;

use Domain\Customer\Actions\DetailCustomerAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Controllers\BaseController;

class DetailCustomerController extends BaseController
{
    public function __invoke(Customer $cus, Request $req)
    {
        try {
            $data = DetailCustomerAction::resolve()->execute($cus, $req->query);

            return $this->resolveForSuccessResponseWith(
                message: 'get data detail',
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
