<?php

namespace Domain\Bahan\Actions\Export;

use App\Exports\Bahan\SatuanExport;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class SatuanExportAction extends Action
{
    public function execute($data)
    {
        return Excel::download(new SatuanExport(), 'test.csv');

    }
}
