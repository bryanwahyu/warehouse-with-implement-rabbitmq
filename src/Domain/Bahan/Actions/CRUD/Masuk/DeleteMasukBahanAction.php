<?php

namespace Domain\Bahan\Actions\CRUD\Masuk;

use Infra\Bahan\Models\History\HistoryStok;
use Infra\Bahan\Models\Masuk\Masuk;
use Infra\Shared\Foundations\Action;

class DeleteMasukBahanAction extends Action
{
    public function execute(Masuk $mas)
    {
        $this->hitungMasuk($mas);
        $this->delete_history($mas);
        $mas->delete();

        return $mas;

    }

    protected function delete_history(Masuk $mas)
    {
        $his = HistoryStok::where('tipe', 'masuk')->where('tipe_id', $mas->id)->first();
        $his->delete();
    }

    protected function hitungMasuk(Masuk $mas)
    {
        $mas->bahan->stok = $mas->bahan->stok - $mas->jumlah;
        $mas->bahan->save();

    }
}
