<?php

namespace Domain\Bahan\Actions\Satuan;

use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Foundations\Action;

class UpdateSatuanAction extends Action
{
    public function execute(Satuan $sat, $data)
    {
        $sat->fill($data);
        $sat->save();

        return $sat;
    }
}
