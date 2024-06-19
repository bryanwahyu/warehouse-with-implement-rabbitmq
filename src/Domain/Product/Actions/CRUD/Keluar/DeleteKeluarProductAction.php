<?php

namespace Domain\Product\Actions\CRUD\Keluar;

use Infra\Produksi\Models\History\HistoryProduct;
use Infra\Produksi\Models\Keluar\KeluarProduct;
use Infra\Shared\Foundations\Action;

class DeleteKeluarProductAction extends Action
{
    public function execute(KeluarProduct $kel)
    {
        $this->handlehitung($kel);
        $this->delete_history($kel);
        $kel->delete();
    }

    protected function delete_history(KeluarProduct $kel)
    {
        $his = HistoryProduct::where('tipe', 'keluar')->where('tipe_id', $kel->id)->first();
        $his->delete();
    }

    protected function handlehitung(KeluarProduct $kel)
    {
        $kel->bahan->stok = $kel->bahan->stok + $kel->jumlah;
        $kel->bahan->save();
    }
}
