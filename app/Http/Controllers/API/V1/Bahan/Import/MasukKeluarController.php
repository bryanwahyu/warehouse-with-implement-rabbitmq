<?php

namespace App\Http\Controllers\API\V1\Bahan\Import;

use Domain\Bahan\Actions\Import\ImportMasukKeluarAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Controllers\BaseController;
use Infra\Shared\Enums\HttpStatus;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class MasukKeluarController extends BaseController
{
    public function __invoke(Bahan $bah, Request $req)
    {
        DB::beginTransaction();
        try {
            $data = ImportMasukKeluarAction::resolve()->execute($bah, $req->file('file'));
            DB::commit();

            return $this->resolveForSuccessResponseWith(
                message: 'Success get a data masuk dan keluar',
                data: $data
            );
        } catch (BadRequestException $th) {
            DB::rollBack();

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage(),
                status: HttpStatus::BadRequest
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());

            return $this->resolveForFailedResponseWith(
                message: $th->getMessage()
            );
        }
    }
}
