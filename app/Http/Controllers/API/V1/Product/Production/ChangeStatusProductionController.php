<?php

namespace App\Http\Controllers\API\V1\Product\Production;

use Domain\Produksi\Actions\ChangeStatusProduksiAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ChangeStatusProductionController extends BaseController
{
    public function __invoke(Production $prod, $status, Request $req)
    {
        try {
            $data = ChangeStatusProduksiAction::resolve()->execute($prod, $status, $req->all(), $req->method());

            return $this->resolveForSuccessResponseWith(
                message: 'gg',
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
