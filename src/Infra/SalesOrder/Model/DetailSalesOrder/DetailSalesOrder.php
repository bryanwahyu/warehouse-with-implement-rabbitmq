<?php

namespace Infra\SalesOrder\Model\DetailSalesOrder;

use Infra\Produksi\Models\Product;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Models\BaseModel;

class DetailSalesOrder extends BaseModel
{
    public function product()
    {
        return $this->belongsTo(related: Product::class);
    }

    public function sales()
    {
        return $this->belongsTo(related: SalesOrder::class, foreignKey: 'sales_order_id');
    }
}
