<?php

namespace Domain\Product\Actions\Import;

use App\Imports\Bahan\MasukKeluarImport;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class ImportMasukKeluarAction extends Action
{
    public function execute(Bahan $bah, $file)
    {
        $rows = Excel::import(new MasukKeluarImport($bah), $file);

    }
}
