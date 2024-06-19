<?php

namespace Domain\Product\Actions\Import;

use App\Imports\Bahan\TambahImport;
use Illuminate\Support\Facades\DB;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class ImportBahanAction extends Action
{
    public function execute($file)
    {
        DB::beginTransaction();

        Excel::import(new TambahImport(), $file);
        DB::commit();

        return 1;
    }
}
