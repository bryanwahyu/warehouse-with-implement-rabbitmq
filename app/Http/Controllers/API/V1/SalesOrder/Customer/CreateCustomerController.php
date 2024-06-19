<?php

namespace App\Http\Controllers\API\V1\SalesOrder\Customer;

use Domain\Customer\Actions\CreateCustomerAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;

class CreateCustomerController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateCustomerAction::resolve()->execute($req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'Data berhasil di buat ',
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
