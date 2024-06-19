<?php

namespace Infra\PurchaseOrder\Models\Detail;

use Infra\Bahan\Models\Bahan;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Models\BaseModel;

class DetailPurchaseOrder extends BaseModel
{
    public function purchaseorder()
    {
        return $this->belongsTo(related: PurchaseOrder::class, foreignKey: 'purchase_order_id');
    }

    public function bahan()
    {
        return $this->belongsTo(related: Bahan::class);
    }
}
