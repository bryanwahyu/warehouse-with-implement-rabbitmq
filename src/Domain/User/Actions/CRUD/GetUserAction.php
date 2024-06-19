<?php

namespace Domain\User\Actions\CRUD;

use Infra\Shared\Foundations\Action;
use Infra\User\Models\User;

class GetUserAction extends Action
{
    protected $user;

    public function execute(User $user)
    {
        $this->user = $user;

    }
}
