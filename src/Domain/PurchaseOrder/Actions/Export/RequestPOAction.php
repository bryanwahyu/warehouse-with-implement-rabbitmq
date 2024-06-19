<?php

namespace Domain\PurchaseOrder\Actions\Export;

use App\Exports\PO\ExportPORequest;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class RequestPOAction extends Action
{
    public function execute(PurchaseOrder $po, $query)
    {
        return Excel::download(new ExportPORequest($po), 'po.csv');
    }
}
