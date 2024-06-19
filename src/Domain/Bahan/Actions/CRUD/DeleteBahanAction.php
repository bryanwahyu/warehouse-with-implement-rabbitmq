<?php

namespace Domain\Bahan\Actions\CRUD;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Foundations\Action;

class DeleteBahanAction extends Action
{
    public function execute(Bahan $bahan)
    {
        $bahan->delete();
    }
}
