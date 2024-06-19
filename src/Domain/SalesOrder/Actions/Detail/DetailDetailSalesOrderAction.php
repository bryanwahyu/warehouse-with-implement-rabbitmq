<?php

namespace Domain\SalesOrder\Actions\Detail;

use Illuminate\Support\Arr;
use Infra\SalesOrder\Model\DetailSalesOrder\DetailSalesOrder;
use Infra\Shared\Foundations\Action;

class DetailDetailSalesOrderAction extends Action
{
    protected $det;

    public function execute(DetailSalesOrder $det, $query)
    {
        $this->det = $det;
        if (Arr::exists($query, 'load')) {
            $this->handleLoad($query['load']);
        }

        return $this->det;

    }

    protected function handleLoad($relationship)
    {
        $load = explode(',', $relationship);
        $this->det = $this->det->load($load);
    }
}
