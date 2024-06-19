<?php

namespace Domain\Product\Actions\Recipe;

use Infra\Produksi\Models\Recipe\Recipe;
use Infra\Shared\Foundations\Action;

class UpdateRecipeAction extends Action
{
    public function execute(Recipe $res, $data)
    {
        return $res->update($data);
    }
}
