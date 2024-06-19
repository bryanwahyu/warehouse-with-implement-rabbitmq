<?php

namespace Domain\Product\Actions\CRUD;

use Infra\Produksi\Models\Product;
use Infra\Shared\Foundations\Action;

class DeleteProductAction extends Action
{
    public function execute(Product $prod)
    {
        $prod->delete();
    }
}
