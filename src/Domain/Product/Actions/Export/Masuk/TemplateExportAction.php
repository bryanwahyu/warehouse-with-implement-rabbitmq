<?php

namespace Domain\Product\Actions\Export\Masuk;

use App\Exports\Product\Masuk\TemplateExport;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class TemplateExportAction extends Action
{
    public function execute($data)
    {
        return Excel::download(new TemplateExport(), 'masuk_keluar_bahan.csv');
    }
}
