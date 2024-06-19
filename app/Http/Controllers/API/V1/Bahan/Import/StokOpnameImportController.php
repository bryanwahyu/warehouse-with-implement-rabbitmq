<?php

namespace App\Http\Controllers\API\V1\Bahan\Import;

use Domain\Bahan\Actions\Import\ImportStokOpnameAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class StokOpnameImportController extends BaseController
{
    public function __invoke(Request $req)
    {
        try {
            $data = ImportStokOpnameAction::resolve()->execute($req->file('file'));

            return $this->resolveForSuccessResponseWith(
                message: 'Berhasil Import Data'
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
