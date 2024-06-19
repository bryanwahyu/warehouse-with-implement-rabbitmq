<?php

namespace App\Http\Controllers\API\V1\Bahan\Import;

use Domain\Bahan\Actions\Import\ImportBahanAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ImportBahanController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {

            $data = ImportBahanAction::resolve()->execute($req->file('file'));

            return $this->resolveForSuccessResponseWith(
                message: 'Import bahan berhasil',
                data: $data
            );
        } catch (BadRequestException $th) {
            return $this->resolveForFailedResponseWith(
                message: $th->getMessage(),
                status: HttpStatus::BadRequest
            );
        } catch (\Exception $th) {
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
