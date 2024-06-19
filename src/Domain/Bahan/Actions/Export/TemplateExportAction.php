<?php

namespace Domain\Bahan\Actions\Export;

use App\Exports\Bahan\TemplateExport;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class TemplateExportAction extends Action
{
    public function execute($data)
    {
        return Excel::download(new TemplateExport(), 'test.csv');
    }
}
