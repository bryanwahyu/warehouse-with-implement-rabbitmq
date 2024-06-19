<?php

namespace Domain\Bahan\Actions\CRUD;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateBahanAction extends Action
{
    public function execute(Bahan $bahan, $data)
    {
        if ($this->checkSKU($bahan, $data['sku'])) {
            throw new BadRequestException('SKU sudah digunakan');
        }

        return $bahan->update($data);
    }

    protected function checkSKU($bahan, $sku)
    {
        return Bahan::whereNot('id', $bahan->id)->where('sku', $sku)->first();
    }
}
