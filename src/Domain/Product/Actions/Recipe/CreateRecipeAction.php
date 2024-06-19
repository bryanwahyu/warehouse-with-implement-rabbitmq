<?php

namespace Domain\Product\Actions\Recipe;

use Infra\Produksi\Models\Recipe\Recipe;
use Infra\Shared\Foundations\Action;

class CreateRecipeAction extends Action
{
    public function execute($data)
    {
        return Recipe::create($data);
    }
}
