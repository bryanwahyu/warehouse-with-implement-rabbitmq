<?php

namespace App\Exports\PO;

use Illuminate\Contracts\View\View;
use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Maatwebsite\Excel\Concerns\FromView;

class ExportPORequest implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $po;

    public function __construct(PurchaseOrder $po)
    {
        $this->po = $po;
    }

    public function view(): View
    {
        $dets = DetailPurchaseOrder::where('purchase_order_id', $this->po->id)->get();

        return view('export.PO.po_request', ['dets' => $dets]);

    }
}
