<?php

namespace Domain\Produksi\Actions;

use Illuminate\Support\Arr;
use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Foundations\Action;

class UpdateProduksiAction extends Action
{
    public function execute(Production $product, $data)
    {
        if ($product->status == 'menyiapkan') {
            $data = Arr::except($data, 'status');
            $product->update($data);
        }
        if ($product->status == 'Proses') {
            $data = Arr::except($data, ['jumlah', 'product_id', 'status']);
            $product->update($data);
        }

        return $product;
    }
}
