<?php

namespace Domain\SalesOrder\Actions;

use Illuminate\Support\Arr;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Foundations\Action;

class DetailSalesOrderAction extends Action
{
    protected $sales;

    public function execute(SalesOrder $sal, $query)
    {
        $this->sales = $sal;
        if (Arr::exists($query, 'load')) {
            $this->handleLoad($query['load']);
        }

        return $this->sales;
    }

    protected function handleLoad($relationship)
    {
        $load = explode(',', $relationship);
        $this->sales = $this->sales->load($load);
    }
}
