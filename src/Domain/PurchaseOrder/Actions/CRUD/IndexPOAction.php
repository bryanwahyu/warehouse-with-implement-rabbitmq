<?php

namespace Domain\PurchaseOrder\Actions\CRUD;

use Illuminate\Support\Arr;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Foundations\Action;

class IndexPOAction extends Action
{
    protected $po;

    public function execute($query)
    {
        $this->po = PurchaseOrder::query();
        if (Arr::exists($query, 'with')) {
            $this->handleWith($query['with']);
        }
        if (Arr::exists($query, 'count')) {
            $this->handleCount($query['count']);
        }
        if (Arr::exists($query, 'status')) {
            $this->handleStatus($query['status']);
        }
        if (Arr::exists($query, 'order') && Arr::exists($query, 'by')) {
            $this->handleOrder($query['order'], $query['by']);
        }
        if (Arr::exists($query, 'page_size') && Arr::exists($query, 'page')) {
            $this->handlePaginate($query['page_size']);

            return $this->po;
        }

        return $this->po->get();
    }

    protected function handleWith($relationship)
    {
        $with = explode(',', $relationship);
        $this->po = $this->po->with($with);
    }

    protected function handleCount($relationship)
    {
        $count = explode(',', $relationship);
        $this->po = $this->po->withCount($count);
    }

    protected function handleOrder($order, $by)
    {

    }

    protected function handleStatus($status)
    {
        $this->po = $this->po->where('status', $status);
    }

    protected function handlePaginate($page_size)
    {
        $this->po = $this->po->paginate($page_size);
    }
}
