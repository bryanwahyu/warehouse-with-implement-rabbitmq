<?php

namespace Domain\History\Filter;

use Illuminate\Support\Carbon;
use Infra\Shared\Foundations\Filter;

class HistoryFilter extends Filter
{
    protected function from($value)
    {
        $from = $value === null ? Carbon::now()->firstOfMonth() : Carbon::parse($value);
        $this->builder->whereDate('created_at', '>=', $from);
    }

    protected function to($value)
    {
        // Jika $value adalah null, gunakan tanggal terakhir bulan ini
        $to = $value === null ? Carbon::now()->endOfMonth() : Carbon::parse($value);
        $this->builder->whereDate('created_at', '<=', $to);
    }

    protected function bahan_id($value)
    {
        $value = explode(',', $value);
        $this->builder->whereIn('bahan_id', $value);
    }

    protected function with($value)
    {
        $value = explode(',', $value);
        $this->builder->with($value);
    }

    protected function page($value)
    {
        $pageSize = $this->request->get('page_size', 15);
        $this->builder->paginate($pageSize, ['*'], 'page', $value);
    }
}