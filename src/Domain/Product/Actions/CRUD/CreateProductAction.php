<?php

namespace Domain\Product\Actions\CRUD;

use Infra\Produksi\Models\Product;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateProductAction extends Action
{
    public function execute($data)
    {
        if ($this->checkSKU($data['sku'])) {
            throw new BadRequestException('SKU Sudah ada tolong buat sku yang berbeda yaa');
        }
        $product = $this->createBahan($data);

        return $product;
    }

    protected function createBahan($req)
    {
        return Product::create($req);
    }

    protected function checkSKU($sku)
    {
        return Product::where('sku', $sku)->first();
    }
}
