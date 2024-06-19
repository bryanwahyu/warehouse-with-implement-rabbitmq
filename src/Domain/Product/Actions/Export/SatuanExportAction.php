<?php

namespace Domain\Product\Actions\Export;

use App\Exports\Product\SatuanExport;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class SatuanExportAction extends Action
{
    public function execute($data)
    {
        return Excel::download(new SatuanExport(), 'test.csv');

    }
}
