<?php

namespace App\Http\Controllers\API\V1\Product\CRUD;

use Domain\Product\Actions\CRUD\DetailProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Product;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DetailProductController extends BaseController
{
    public function __invoke(Request $req, Product $prod)
    {
        try {
            $data = DetailProductAction::resolve()->execute($prod, $req->query());

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
