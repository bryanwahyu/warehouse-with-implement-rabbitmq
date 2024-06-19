<?php

namespace App\Http\Controllers\API\V1\SalesOrder\Customer;

use Domain\Customer\Actions\DeleteCustomerAction;
use Illuminate\Support\Facades\Log;
use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Controllers\BaseController;

class DeleteCustomerController extends BaseController
{
    public function __invoke(Customer $cus)
    {
        try {
            $data = DeleteCustomerAction::resolve()->execute($cus);

            return $this->resolveForSuccessResponseWith(
                message: 'Data sudah disimpan',
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
