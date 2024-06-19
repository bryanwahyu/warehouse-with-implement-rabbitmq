<?php

namespace Domain\Product\Actions\CRUD\Keluar;

use Infra\Produksi\Models\History\HistoryProduct;
use Infra\Produksi\Models\Keluar\KeluarProduct;
use Infra\Produksi\Models\Product;
use Infra\Shared\Foundations\Action;
use Infra\Shared\Services\RabbitMQService;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreateKeluarProductAction extends Action
{
    public function execute($product_id, $data)
    {
        $data['product_id'] = $product_id;
        $bahan = Product::find($product_id);
        if (! $bahan) {
            throw new BadRequestException('Bahan tidak tersedia');
        }
        $keluar = KeluarProduct::create($data);
        $this->add_history($data, $keluar->id);
        $this->handleHitung($keluar);

        return $keluar;
    }

    protected function add_history($data, $id)
    {
        $data['tipe'] = 'keluar';
        $data['tipe_id'] = $id;
        HistoryProduct::create($data);
        //kirim ke rabbitmq
        $rabbitMQService = new RabbitMQService();
        $message = json_encode($data);
        $rabbitMQService->publish($message);
    }

    protected function handleHitung(KeluarProduct $kel)
    {
        $kel->product->stok = $kel->product->stok - $kel->jumlah;
        $kel->product->save();

    }
}
