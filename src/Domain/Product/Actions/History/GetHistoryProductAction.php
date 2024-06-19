<?php

namespace Domain\Product\Actions\History;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Infra\Produksi\Models\History\HistoryProduct;
use Infra\Shared\Foundations\Action;

class GetHistoryProductAction extends Action
{
    protected $his;

    public function execute($query)
    {
        $this->his = HistoryProduct::query();
        $from = Carbon::now()->firstOfMonth();
        $end = Carbon::now()->endOfMonth();
        if (Arr::exists($query, 'from')) {
            $from = Carbon::parse($query['from']);
        }
        if (Arr::exists($query, 'to')) {
            $end = Carbon::parse($query['to']);
        }
        if (Arr::exists($query, 'product_id')) {
            $this->handleProduct($query['product_id']);
        }
        if (Arr::exists($query, 'with')) {
            $this->handleWith($query['with']);
        }
        $this->handlefromto($from, $end);
        if (Arr::exists($query, 'page') && Arr::exists($query, 'page_size')) {
            $this->handlePaginate($query['page_size']);

            return $this->his;
        }

        return $this->his->get();
    }

    protected function handleProduct($bahan)
    {
        $id = explode(',', $bahan);
        $this->his = $this->his->whereIn('product_id', $id);
    }

    protected function handlePaginate($page_size = 10)
    {
        $this->his = $this->his->paginate($page_size);
    }

    protected function handleWith($relationship)
    {
        $with = explode(',', $relationship);

        $this->his = $this->his->with($with);
    }

    protected function handlefromto($from, $to)
    {
        $this->his = $this->his->whereBetween('created_at', [$from, $to]);
    }
}
