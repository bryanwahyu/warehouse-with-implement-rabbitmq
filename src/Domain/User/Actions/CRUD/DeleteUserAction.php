<?php

namespace Domain\User\Actions\CRUD;

use Infra\Shared\Foundations\Action;
use Infra\User\Models\User;

class DeleteUserAction extends Action
{
    public function execute(User $user)
    {
        $user->delete();
    }
}
