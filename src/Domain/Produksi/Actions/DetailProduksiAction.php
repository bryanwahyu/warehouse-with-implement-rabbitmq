<?php

namespace Domain\Produksi\Actions;

use Illuminate\Support\Arr;
use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Foundations\Action;

class DetailProduksiAction extends Action
{
    protected $prod;

    public function execute(Production $prod, $query)
    {
        $this->prod = $prod;
        if (Arr::exists($query, 'load')) {
            $this->handleLoad($query['load']);
        }

        return $this->prod;
    }

    protected function handleLoad($relationship)
    {
        $load = explode(',', $relationship);
        $this->prod = $this->prod->load($load);
    }
}
