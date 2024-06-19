<?php

namespace Domain\PurchaseOrder\Actions\Supplier;

use Illuminate\Support\Arr;
use Infra\PurchaseOrder\Models\Supplier\Supplier;
use Infra\Shared\Foundations\Action;

class IndexSupplierAction extends Action
{
    protected $sup;

    public function execute($query)
    {
        $this->sup = Supplier::query();
        if (Arr::exists($query, 'select')) {
            return $this->htmlfunction();
        }

        return $this->sup->get();
    }

    protected function htmlfunction()
    {
        $html = '<option value=""> Pilih Supplier </option>';
        foreach ($this->sup->get() as $item) {
            $html = $html.'<option value="'.$item->id.'">'.$item->nama.' </option>';
        }

        return $html;
    }
}
