<?php

namespace Domain\Bahan\Actions\Category;

use Illuminate\Support\Arr;
use Infra\Bahan\Models\Category\Category;
use Infra\Shared\Foundations\Action;

class IndexCategoryAction extends Action
{
    protected $cat;

    public function execute($query)
    {
        $this->cat = Category::query();
        if (Arr::exists($query, 'with')) {
            $this->handleWith($query['with']);
        }
        if (Arr::exists($query, 'count')) {
            $this->handleCount($query['count']);
        }
        if (Arr::exists($query, 'select') && $query['select'] == true) {
            return $this->htmlfunction();
        }

        return $this->cat->get();
    }

    protected function handleWith($relationship)
    {
        $with = explode(',', $relationship);
        $this->cat = $this->cat->with($with);
    }

    protected function handleCount($relationship)
    {
        $with = explode(',', $relationship);
        $this->cat = $this->cat->withCount($with);
    }

    protected function htmlfunction()
    {
        $html = '<option value=""> Pilih Category </option>';
        foreach ($this->cat->get() as $cat) {
            $html = $html.'<option value="'.$cat->id.'">'.$cat->name.' </option>';
        }

        return $html;
    }
}
