<?php

namespace Domain\Product\Actions\CRUD;

use Infra\Produksi\Models\Product;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class UpdateProductAction extends Action
{
    public function execute(Product $product, $data)
    {
        if ($this->checkSKU($product, $data['sku'])) {
            throw new BadRequestException('SKU sudah digunakan');
        }

        return $product->update($data);
    }

    protected function checkSKU($product, $sku)
    {
        return Product::whereNot('id', $product->id)->where('sku', $sku)->first();
    }
}
