<?php

namespace App\Http\Controllers\API\V1\PurchaseOrder\CRUD;

use Domain\PurchaseOrder\Actions\CRUD\CreatePOAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreatePOController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreatePOAction::resolve()->execute($req->all());
            $this->resolveForSuccessResponseWith(
                message: 'created po successfull',
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
