<?php

namespace Domain\Product\Actions\CRUD\Masuk;

use Infra\Produksi\Models\History\HistoryProduct;
use Infra\Produksi\Models\Masuk\MasukProduct;
use Infra\Shared\Foundations\Action;

class CreateMasukProductAction extends Action
{
    public function execute($product_id, $data)
    {
        $data['product_id'] = $product_id;
        $masuk = MasukProduct::create($data);
        $this->add_history($data, $masuk->id);
        $this->hitung_stok($masuk);

        return $masuk;
    }

    protected function add_history($data, $id)
    {
        $data['tipe'] = 'masuk';
        $data['tipe_id'] = $id;

        HistoryProduct::create($data);
    }

    protected function hitung_stok(MasukProduct $masuk)
    {
        $masuk->product->stok = $masuk->product->stok + $masuk->jumlah;
        $masuk->product->save();
    }
}
