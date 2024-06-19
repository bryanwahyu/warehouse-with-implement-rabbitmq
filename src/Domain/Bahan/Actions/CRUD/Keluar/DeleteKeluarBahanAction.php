<?php

namespace Domain\Bahan\Actions\CRUD\Keluar;

use Infra\Bahan\Models\History\HistoryStok;
use Infra\Bahan\Models\Keluar\Keluar;
use Infra\Shared\Foundations\Action;

class DeleteKeluarBahanAction extends Action
{
    public function execute(Keluar $kel)
    {
        $this->handlehitung($kel);
        $this->delete_history($kel);
        $kel->delete();
    }

    protected function delete_history(Keluar $kel)
    {
        $his = HistoryStok::where('tipe', 'keluar')->where('tipe_id', $kel->id)->first();
        $his->delete();
    }

    protected function handlehitung(Keluar $kel)
    {
        $kel->bahan->stok = $kel->bahan->stok + $kel->jumlah;
        $kel->bahan->save();
    }
}
