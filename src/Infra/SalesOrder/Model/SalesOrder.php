<?php

namespace Infra\SalesOrder\Model;

use Infra\SalesOrder\Model\Customer\Customer;
use Infra\SalesOrder\Model\DetailSalesOrder\DetailSalesOrder;
use Infra\Shared\Models\BaseModel;

class SalesOrder extends BaseModel
{
    public function customer()
    {
        return $this->belongsTo(related: Customer::class);
    }

    public function detail()
    {
        return $this->hasMany(related: DetailSalesOrder::class, foreignKey: 'sales_order_id');
    }
}
