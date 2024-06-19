<?php

namespace Domain\Bahan\Actions\Satuan;

use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Foundations\Action;

class DeleteSatuanAction extends Action
{
    public function execute(Satuan $satuan)
    {
        $satuan->delete();

        return true;
    }
}
