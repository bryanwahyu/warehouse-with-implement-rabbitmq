<?php

namespace Domain\Bahan\Actions\CRUD\Masuk;

use Infra\Bahan\Models\History\HistoryStok;
use Infra\Bahan\Models\Masuk\Masuk;
use Infra\Shared\Foundations\Action;
use Infra\Shared\Services\RabbitMQService;

class CreateMasukBahanAction extends Action
{
    public function execute($bahan_id, $data)
    {
        $data['bahan_id'] = $bahan_id;
        $masuk = Masuk::create($data);
        $this->add_history($data, $masuk->id);
        $this->hitung_stok($masuk);

        return $masuk;
    }

    protected function add_history($data, $id)
    {
        $data['tipe'] = 'masuk';
        $data['tipe_id'] = $id;
        HistoryStok::create($data);
        //kirim ke rabbitmq
        $rabbitMQService = new RabbitMQService();
        $message = json_encode($data);
        $rabbitMQService->publish($message);
    }

    protected function hitung_stok(Masuk $masuk)
    {
        $masuk->bahan->stok = $masuk->bahan->stok + $masuk->jumlah;
        $masuk->bahan->save();
    }
}
