<?php

namespace App\Http\Controllers\API\V1\Product\Production;

use Domain\Produksi\Actions\CreateProduksiAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateProductionController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = CreateProduksiAction::resolve()->execute($req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'ssi',
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
