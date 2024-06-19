<?php

namespace Domain\Bahan\Actions\Satuan;

use Illuminate\Support\Arr;
use Infra\Bahan\Models\Satuan\Satuan;
use Infra\Shared\Foundations\Action;

class IndexSatuanAction extends Action
{
    protected $sat;

    public function execute($query)
    {
        $this->sat = Satuan::query();
        if (Arr::exists($query, 'select') && $query['select'] == true) {
            return $this->htmlfunction();
        }

        return $this->sat->get();
    }

    protected function htmlfunction()
    {
        $html = '<option value=""> Pilih Satuan </option>';
        foreach ($this->sat->get() as $cat) {
            $html = $html.'<option value="'.$cat->id.'">'.$cat->name.' </option>';
        }

        return $html;
    }
}
