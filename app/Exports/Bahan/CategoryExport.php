<?php

namespace App\Exports\Bahan;

use Illuminate\Contracts\View\View;
use Infra\Bahan\Models\Category\Category;
use Maatwebsite\Excel\Concerns\FromView;

class CategoryExport implements FromView
{
    public function view(): View
    {
        return view('export.bahan.category', ['cats' => Category::all()]);
    }
}
