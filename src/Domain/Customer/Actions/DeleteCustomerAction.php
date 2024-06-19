<?php

namespace Domain\Customer\Actions;

use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Foundations\Action;

class DeleteCustomerAction extends Action
{
    public function execute(Customer $cus)
    {
        $cus->delete();

        return true;
    }
}
