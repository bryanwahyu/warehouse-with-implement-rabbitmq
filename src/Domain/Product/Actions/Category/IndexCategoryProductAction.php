<?php

namespace Domain\Product\Actions\Category;

use Domain\Product\Filter\CategoryFilter;
use Illuminate\Http\Request;
use Infra\Produksi\Models\Category\CategoryProduct;
use Infra\Shared\Foundations\Action;

class IndexCategoryProductAction extends Action
{
    protected $cat;

    public function execute(Request $request)
    {
        $filter = new CategoryFilter($request);
        if ($request->has('select') && $request->select == 'yes') {
            return $this->htmlfunction();
        }

        return $filter->apply(CategoryProduct::query())->get();
    }

    protected function htmlfunction()
    {
        $html = '<option value=""> Pilih Category </option>';
        foreach (CategoryProduct::query()->get() as $cat) {
            $html = $html.'<option value="'.$cat->id.'">'.$cat->name.' </option>';
        }

        return $html;
    }
}
