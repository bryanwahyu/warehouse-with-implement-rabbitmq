<?php

namespace App\Exports\History;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Infra\Bahan\Models\History\HistoryStok;
use Maatwebsite\Excel\Concerns\FromView;

class HistoryExport implements FromView
{
    protected $from;

    protected $end;

    public function __construct(Carbon $from, Carbon $end)
    {
        $this->from = $from;
        $this->end = $end;
    }

    public function view(): View
    {
        $his = HistoryStok::whereBetween('created_at', [$this->from, $this->end])->get();

        return view('export.History.stok', ['hists' => $his]);
    }
}
