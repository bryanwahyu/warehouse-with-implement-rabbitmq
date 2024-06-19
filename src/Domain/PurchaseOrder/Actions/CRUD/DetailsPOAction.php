<?php

namespace Domain\PurchaseOrder\Actions\CRUD;

use Illuminate\Support\Arr;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Foundations\Action;

class DetailsPOAction extends Action
{
    protected $po;

    public function execute(PurchaseOrder $po, $query)
    {
        $this->po = $po;
        if (Arr::exists($query, 'load')) {
            $this->handleLoad($query['load']);
        }
        if (Arr::exists($query, 'count')) {
            $this->handleCount($query['count']);
        }

        return $this->po;
    }

    protected function handleLoad($relationship)
    {
        $load = explode(',', $relationship);

        $this->po = $this->po->load($load);
    }

    protected function handleCount($relationship)
    {
        $count = explode(',', $relationship);
        $this->po = $this->po->LoadCount($count);
    }
}
