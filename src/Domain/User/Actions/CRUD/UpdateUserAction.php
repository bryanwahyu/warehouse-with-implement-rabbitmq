<?php

namespace Domain\User\Actions\CRUD;

use Infra\Shared\Foundations\Action;
use Infra\User\Models\User;

class UpdateUserAction extends Action
{
    public function execute($data, User $user)
    {
        $user->update($data);
    }
}
