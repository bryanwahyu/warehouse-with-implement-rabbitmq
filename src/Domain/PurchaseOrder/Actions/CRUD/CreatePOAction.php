<?php

namespace Domain\PurchaseOrder\Actions\CRUD;

use Domain\PurchaseOrder\Actions\CRUD\Details\CreateDetailPOAction;
use Illuminate\Support\Arr;
use Infra\PurchaseOrder\Models\PurchaseOrder;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CreatePOAction extends Action
{
    public function execute($data)
    {
        if (Arr::exists($data, 'details')) {
            $clean = Arr::except($data, 'details');
            $details = $data['details'];
        }
        $po = $this->create($clean);
        if ($details) {
            $this->details($po, $details);
        }

        return true;
    }

    protected function create($cleandata)
    {
        $check = PurchaseOrder::where('code', $cleandata['code'])->first();
        if ($check) {
            throw new BadRequestException('code sudah di  pakai');
        }
        $data = PurchaseOrder::create($cleandata);

        return $data;
    }

    protected function details($po, $details)
    {
        foreach ($details as $data) {
            $data['purchase_order_id'] = $po->id;
            CreateDetailPOAction::resolve()->execute($data);
        }

    }
}
