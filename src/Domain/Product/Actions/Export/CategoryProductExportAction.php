<?php

namespace Domain\Product\Actions\Export;

use App\Exports\Product\CategoryExport;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class CategoryProductExportAction extends Action
{
    public function execute($data)
    {
        return Excel::download(new CategoryExport(), 'category_list.csv');
    }
}
