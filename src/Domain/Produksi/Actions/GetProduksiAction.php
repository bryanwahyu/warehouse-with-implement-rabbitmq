<?php

namespace Domain\Produksi\Actions;

use Illuminate\Support\Arr;
use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Foundations\Action;

class GetProduksiAction extends Action
{
    protected $prod;

    public function execute($query)
    {
        $this->prod = Production::query();
        if (Arr::exists($query, 'with')) {
            $this->handleWith($query['with']);
        }

        return $this->prod->get();
    }

    protected function handleWith($relationship)
    {
        $with = explode(',', $relationship);
        $this->prod = $this->prod->with($with);
    }
}
