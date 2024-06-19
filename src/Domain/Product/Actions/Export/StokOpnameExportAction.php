<?php

namespace Domain\Product\Actions\Export;

use App\Exports\Product\StokOpnameExport;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class StokOpnameExportAction extends Action
{
    public function execute()
    {
        return Excel::download(new StokOpnameExport(), 'stok_opname.csv');
    }
}
