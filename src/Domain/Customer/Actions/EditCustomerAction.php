<?php

namespace Domain\Customer\Actions;

use Infra\SalesOrder\Model\Customer\Customer;
use Infra\Shared\Foundations\Action;

class EditCustomerAction extends Action
{
    public function execute(Customer $cus, $data)
    {
        $cus->update($data);

        return $cus;
    }
}
