<?php

namespace Domain\Customer\Actions;

use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Foundations\Action;

class DetailCustomerAction extends Action
{
    protected $cus;

    public function execute(Customer $cus, $query)
    {
        $this->cus = $cus;

        return $this->cus;
    }
}
