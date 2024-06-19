<?php

namespace Domain\History\Actions;

use App\Exports\History\HistoryExport;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Infra\Shared\Foundations\Action;
use Maatwebsite\Excel\Facades\Excel;

class ExportHistoryStokAction extends Action
{
    public function execute($query)
    {
        $from = Carbon::now()->firstOfMonth();
        $end = Carbon::now()->endOfMonth();
        if (Arr::exists($query, 'from')) {
            $from = Carbon::parse($query['from']);
        }
        if (Arr::exists($query, 'to')) {
            $end = Carbon::parse($query['to']);
        }

        return Excel::download(new HistoryExport($from, $end), 'data.csv');
    }
}
