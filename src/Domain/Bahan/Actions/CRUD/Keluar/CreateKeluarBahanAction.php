<?php

namespace Domain\Bahan\Actions\CRUD\Keluar;

use Infra\Bahan\Models\Bahan;
use Infra\Bahan\Models\History\HistoryStok;
use Infra\Bahan\Models\Keluar\Keluar;
use Infra\Shared\Foundations\Action;
use Infra\Shared\Services\RabbitMQService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateKeluarBahanAction extends Action
{
    public function execute($bahan_id, $data)
    {
        $data['bahan_id'] = $bahan_id;
        $bahan = Bahan::find($bahan_id);
        if (! $bahan) {
            throw new BadRequestException('Bahan tidak tersedia');
        }
        $keluar = Keluar::create($data);
        $this->add_history($data, $keluar->id);
        $this->handleHitung($keluar);

        return $keluar;
    }

    protected function add_history($data, $id)
    {
        $data['tipe'] = 'keluar';
        $data['tipe_id'] = $id;
        HistoryStok::create($data);

        $rabbitMQService = new RabbitMQService();
        $message = json_encode($data);
        $rabbitMQService->publish($message);
    }

    protected function handleHitung(Keluar $kel)
    {
        $kel->bahan->stok = $kel->bahan->stok - $kel->jumlah;
        $kel->bahan->save();

    }
}
