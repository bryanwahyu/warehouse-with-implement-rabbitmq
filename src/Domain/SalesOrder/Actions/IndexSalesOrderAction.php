<?php

namespace Domain\SalesOrder\Actions;

use Illuminate\Support\Arr;
use Infra\SalesOrder\Model\SalesOrder;
use Infra\Shared\Foundations\Action;

class IndexSalesOrderAction extends Action
{
    protected $sales;

    public function execute($query)
    {
        $this->sales = SalesOrder::query();
        if (Arr::exists($query, 'with')) {
            $this->handleWith($query['with']);
        }
        if (Arr::exists($query, 'count')) {
            $this->handleWithCount($query['count']);
        }

        if (Arr::exists($query, 'page') && Arr::exists($query, 'page_size')) {
            $this->handlePaginate($query['page_size']);

            return $this->sales;
        }

        return $this->sales->get();
    }

    protected function handleWith($relationship)
    {
        $with = explode(',', $relationship);
        $this->sales = $this->sales->with($with);
    }

    protected function handleOrderBy($order, $by)
    {

    }

    protected function handleWithCount($relationship)
    {
        $with = explode(',', $relationship);
        $this->sales = $this->sales->withCount($with);
    }

    protected function handlePaginate($page_size)
    {
        $this->sales = $this->sales->paginate($page_size);
    }
}
