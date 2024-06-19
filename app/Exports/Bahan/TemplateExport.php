<?php

namespace App\Exports\Bahan;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TemplateExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('export.bahan.template');
    }
}
