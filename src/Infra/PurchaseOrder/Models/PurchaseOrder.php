<?php

namespace Infra\PurchaseOrder\Models;

use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Models\BaseModel;

class PurchaseOrder extends BaseModel
{
    public function supply()
    {
        return $this->belongsTo(related: Supplier::class, foreignKey: 'supplier_id');
    }

    public function detail()
    {
        return $this->hasMany(related: DetailPurchaseOrder::class, foreignKey: 'purchase_order_id');
    }

    public function unchecked_detail()
    {
        return $this->detail()->where('status', 0);
    }
}
