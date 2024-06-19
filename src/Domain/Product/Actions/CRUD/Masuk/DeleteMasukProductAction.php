<?php

namespace Domain\Product\Actions\CRUD\Masuk;

use Infra\Produksi\Models\History\HistoryProduct;
use Infra\Produksi\Models\Masuk\MasukProduct;
use Infra\Shared\Foundations\Action;

class DeleteMasukProductAction extends Action
{
    public function execute(MasukProduct $mas)
    {
        $this->hitungMasuk($mas);
        $this->delete_history($mas);
        $mas->delete();

        return $mas;

    }

    protected function delete_history(MasukProduct $mas)
    {
        $his = HistoryProduct::where('tipe', 'masuk')->where('tipe_id', $mas->id)->first();
        $his->delete();
    }

    protected function hitungMasuk(MasukProduct $mas)
    {
        $mas->product->stok = $mas->product->stok - $mas->jumlah;
        $mas->product->save();

    }
}
