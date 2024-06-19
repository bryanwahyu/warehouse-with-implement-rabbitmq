<?php

namespace App\Http\Controllers\API\V1\Bahan\CRUD;

use Domain\Bahan\Actions\CRUD\UpdateBahanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateBahanController extends BaseController
{
    public function __invoke(Bahan $bah, Request $req)
    {
        try {
            $data = UpdateBahanAction::resolve()->execute($bah, $req->all());

            return $this->resolveForSuccessResponseWith(
                message: 'success get a data category',
                data: $data
            );
        } catch (BadRequestException $th) {
            return $this->resolveForFailedResponseWith(
                message: $th->getMessage(),
                status: HttpStatus::BadRequest
            );
        } catch (\Throwable $th) {
            Log::alert($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
