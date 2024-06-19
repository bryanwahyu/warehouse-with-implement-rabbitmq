<?php

namespace App\Http\Controllers\API\V1\SalesOrder\Customer;

use Domain\Customer\Actions\EditCustomerAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Controllers\BaseController;

class UpdateCustomerController extends BaseController
{
    public function __invoke(Customer $cus, Request $req)
    {
        try {
            $data = EditCustomerAction::resolve()->execute($cus, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'Data  berhasil diedit',
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
