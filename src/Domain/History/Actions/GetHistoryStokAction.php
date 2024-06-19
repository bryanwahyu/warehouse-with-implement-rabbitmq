<?php

namespace Domain\History\Actions;

use Domain\History\Filter\HistoryFilter;
use Illuminate\Http\Request;
use Infra\Bahan\Models\History\HistoryStok;
use Infra\Shared\Foundations\Action;

class GetHistoryStokAction extends Action
{
    public function execute(Request $request)
    {
        $filter = new HistoryFilter($request);

        return $filter->apply(HistoryStok::query())->get();
    }
}
