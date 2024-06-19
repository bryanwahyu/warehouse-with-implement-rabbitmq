<?php

namespace App\Http\Controllers\API\V1\Product\Masuk;

use Domain\Product\Actions\CRUD\Masuk\GetMasukProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class GetMasukProductController extends BaseController
{
    public function __invoke(Request $req)
    {

        try {
            $data = GetMasukProductAction::resolve()->execute($req->query());

            return $this->resolveForSuccessResponseWith(
                message: 'success data',
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
