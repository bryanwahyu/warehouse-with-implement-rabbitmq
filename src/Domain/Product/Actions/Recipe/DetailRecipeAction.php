<?php

namespace Domain\Product\Actions\Recipe;

use Illuminate\Support\Arr;
use Infra\Produksi\Models\Recipe\Recipe;
use Infra\Shared\Foundations\Action;

class DetailRecipeAction extends Action
{
    protected $res;

    public function execute(Recipe $res, $query)
    {

        $this->res = $res;
        if (Arr::exists($query, 'load')) {
            $this->handleLoad($query['load']);
        }

        return $this->res;
    }

    protected function handleLoad($relationship)
    {

        $load = explode(',', $relationship);
        $this->res = $this->res->load($load);

    }
}
