<?php

namespace App\Exports\Bahan;

use Illuminate\Contracts\View\View;
use Infra\Bahan\Models\Satuan\Satuan;
use Maatwebsite\Excel\Concerns\FromView;

class SatuanExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        return view('export.bahan.satuan', ['sats' => Satuan::all()]);
    }
}
