<?php

namespace Domain\Bahan\Actions\CRUD;

use Domain\Bahan\Filter\BahanFilter;
use Illuminate\Http\Request;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Foundations\Action;

class IndexBahanAction extends Action
{
    public function execute(Request $req)
    {
        $filter = new BahanFilter($req);

        return $filter->apply(Bahan::query())->get();
    }
}
