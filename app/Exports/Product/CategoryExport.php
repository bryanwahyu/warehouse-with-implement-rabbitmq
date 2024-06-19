<?php

namespace App\Exports\Product;

use Illuminate\Contracts\View\View;
use Infra\Produksi\Models\Category\CategoryProduct;
use Maatwebsite\Excel\Concerns\FromView;

class CategoryExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View
    {
        $cats = CategoryProduct::all();

        return view('export.bahan.category', ['cats' => $cats]);
    }
}
