<?php

namespace Domain\PurchaseOrder\Actions\CRUD\Details;

use Illuminate\Support\Arr;
use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\Shared\Foundations\Action;

class CreateDetailPOAction extends Action
{
    public function execute($data)
    {
        $data1 = Arr::only($data, ['bahan_id', 'price', 'purchase_order_id', 'price', 'stok_order']);

        return DetailPurchaseOrder::create($data1);
    }
}
