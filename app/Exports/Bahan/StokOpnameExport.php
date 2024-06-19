<?php

namespace App\Exports\Bahan;

use Illuminate\Contracts\View\View;
use Infra\Bahan\Models\Bahan;
use Maatwebsite\Excel\Concerns\FromView;

class StokOpnameExport implements FromView
{
    public function view(): View
    {
        $Bahan = Bahan::all();

        return view('export.bahan.StokOpname', ['data' => $Bahan]);
    }
}
