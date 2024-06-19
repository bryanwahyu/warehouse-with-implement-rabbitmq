<?php

namespace Domain\PurchaseOrder\Actions\CRUD\Details;

use Illuminate\Support\Arr;
use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\Shared\Foundations\Action;

class DetailDetailPOAction extends Action
{
    protected $det;

    public function execute(DetailPurchaseOrder $det, $query)
    {
        $this->det = $det;
        if (Arr::exists($query, 'load')) {
            $this->load($query['load']);
        }

        return $this->det;
    }

    protected function load($relationship)
    {
        $load = explode(',', $relationship);
        $this->det = $this->det->load($load);
    }
}
