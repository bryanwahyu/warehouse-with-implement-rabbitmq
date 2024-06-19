<?php

namespace Domain\User\Actions\CRUD;

use Infra\Shared\Foundations\Action;
use Infra\User\Models\User;

class CreateUserAction extends Action
{
    public function execute($data)
    {
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        return $user;
    }
}
