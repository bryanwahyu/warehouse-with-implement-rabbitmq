<?php

namespace Domain\Bahan\Actions\Export;

use App\Exports\Bahan\CategoryExport;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class CategoryExportAction extends Action
{
    public function execute($data)
    {
        return Excel::download(new CategoryExport(), 'category_list.csv');
    }
}
