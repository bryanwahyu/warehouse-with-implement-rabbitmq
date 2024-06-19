<?php

namespace Domain\Customer\Actions;

use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Foundations\Action;

class CreateCustomerAction extends Action
{
    public function execute($data)
    {
        return Customer::create($data);

    }
}
