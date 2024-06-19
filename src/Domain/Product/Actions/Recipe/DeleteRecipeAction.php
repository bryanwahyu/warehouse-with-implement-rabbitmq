<?php

namespace Domain\Product\Actions\Recipe;

use Infra\Produksi\Models\Recipe\Recipe;
use Infra\Shared\Foundations\Action;

class DeleteRecipeAction extends Action
{
    public function execute(Recipe $res)
    {
        $res->delete();
    }
}
