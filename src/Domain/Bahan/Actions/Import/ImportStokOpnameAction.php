<?php

namespace Domain\Bahan\Actions\Import;

use App\Imports\Bahan\StokOpnameImport;
use Illuminate\Support\Facades\DB;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class ImportStokOpnameAction extends Action
{
    public function execute($file)
    {
        DB::beginTransaction();
        Excel::import(new StokOpnameImport, $file);
        DB::commit();

        return 1;
    }
}
