<?php

namespace Domain\Bahan\Actions\CRUD;

use Infra\Bahan\Models\Bahan;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateBahanAction extends Action
{
    public function execute($data)
    {
        if ($this->checkSKU($data['sku'])) {
            throw new BadRequestException('SKU Sudah ada tolong buat sku yang berbeda yaa');
        }
        $bahan = $this->createBahan($data);

        return $bahan;
    }

    protected function createBahan($req)
    {
        return Bahan::create($req);
    }

    protected function checkSKU($sku)
    {
        return Bahan::where('SKU', $sku)->first();
    }
}
