<?php

namespace Domain\Customer\Actions;

use Illuminate\Support\Arr;
use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Foundations\Action;

class IndexCustomerAction extends Action
{
    protected $cus;

    public function execute($query)
    {
        $this->cus = Customer::query();

        if (Arr::exists($query, 'page') && Arr::exists($query, 'page_size')) {
            $this->handlePaginate($query['page_size']);

            return $this->cus;
        }

        return $this->cus->get();
    }

    protected function handlePaginate($page_size)
    {
        $this->cus = $this->cus->paginate($page_size);
    }
}
