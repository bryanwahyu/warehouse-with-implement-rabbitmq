<?php

namespace Domain\Produksi\Actions;

use Carbon\Carbon;
use Infra\Produksi\Models\Product;
use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateProduksiAction extends Action
{
    public function execute($data)
    {
        $product = Product::find($data['product_id']);
        if (! $product) {
            throw new BadRequestException('Product tidak di temukan');
        }
        $data['tanggal_selesai'] = Carbon::now()->addDays($product->time_product);
        $prod = Production::create($data);

        return $prod;
    }
}
