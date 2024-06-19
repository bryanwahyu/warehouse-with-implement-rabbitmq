<?php

namespace Domain\PurchaseOrder\Actions\CRUD\Details;

use Domain\Bahan\Actions\CRUD\Masuk\CreateMasukBahanAction;
use Infra\PurchaseOrder\Models\Detail\DetailPurchaseOrder;
use Infra\Shared\Foundations\Action;

class UpdateDetailPOAction extends Action
{
    public function execute(DetailPurchaseOrder $det, $data)
    {
        $det->update($data);
        if ($det->status == 1) {
            $data = [];
            $data['keterangan'] = 'po-'.$det->purchaseorder->code;
            $data['nama'] = $det->purchaseorder->client;
            $data['jumlah'] = $det->stok_order;
            CreateMasukBahanAction::resolve()->execute($det->bahan_id, $data);
        }

        return $det;
    }
}
