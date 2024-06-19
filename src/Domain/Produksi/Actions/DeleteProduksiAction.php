<?php

namespace Domain\Produksi\Actions;

use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class DeleteProduksiAction extends Action
{
    public function execute(Production $product)
    {
        if ($product->status != 'menyiapkan') {
            throw new BadRequestException('tidak bisa menghapus karena sudah di simpan di sistem');
        }
        $product->delete();

        return true;

    }
}
