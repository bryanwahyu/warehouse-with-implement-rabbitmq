<?php

namespace Domain\User\Actions\CRUD;

use Infra\Shared\Foundations\Action;
use Infra\User\Models\User;

class DetailUserAction extends Action
{
    protected $user;

    public function execute($query, User $user)
    {
        $this->user = $user;

        return $this->user;
    }
}
