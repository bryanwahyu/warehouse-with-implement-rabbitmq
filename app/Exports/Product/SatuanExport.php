<?php

namespace App\Exports\Product;

use Illuminate\Contracts\View\View;
use Infra\Produksi\Models\Satuan\SatuanProduct;
use Maatwebsite\Excel\Concerns\FromView;

class SatuanExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $sats = SatuanProduct::all();

        return view('export.bahan.satuan', ['sats' => $sats]);
    }
}
