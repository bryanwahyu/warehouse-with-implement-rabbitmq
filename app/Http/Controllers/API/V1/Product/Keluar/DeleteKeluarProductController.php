<?php

namespace App\Http\Controllers\API\V1\Product\Keluar;

use Domain\Product\Actions\CRUD\Keluar\DeleteKeluarProductAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Produksi\Models\Keluar\KeluarProduct;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeleteKeluarProductController extends BaseController
{
    public function __invoke(Request $req, KeluarProduct $kel)
    {

        try {
            $data = DeleteKeluarProductAction::resolve()->execute($kel);

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
