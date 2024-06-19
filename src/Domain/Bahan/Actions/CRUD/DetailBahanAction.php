<?php

namespace Domain\Bahan\Actions\CRUD;

use Illuminate\Support\Arr;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Foundations\Action;

class DetailBahanAction extends Action
{
    protected $bahan;

    public function execute(Bahan $bahan, $query)
    {
        $this->bahan = $bahan;
        if (Arr::exists($query, 'with')) {
            $this->handleLoad($query['with']);
        }

        return $this->bahan;
    }

    protected function handleLoad($relationship)
    {
        $with = explode(',', $relationship);
        $this->bahan = $this->bahan->load($with);
    }
}
