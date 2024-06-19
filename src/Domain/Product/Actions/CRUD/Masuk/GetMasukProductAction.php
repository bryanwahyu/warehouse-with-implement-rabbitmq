<?php

namespace Domain\Product\Actions\CRUD\Masuk;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Infra\Produksi\Models\Masuk\MasukProduct;
use Infra\Shared\Foundations\Action;

class GetMasukProductAction extends Action
{
    protected $mas;

    public function execute($query)
    {
        $this->mas = MasukProduct::query();
        $from = Carbon::now()->firstOfMonth();
        $end = Carbon::now()->endOfMonth();
        if (Arr::exists($query, 'from')) {
            $from = $query['from'];
        }
        if (Arr::exists($query, 'end')) {
            $end = $query['end'];
        }
        if (Arr::exists($query, 'product_id')) {
            $this->handleProduct($query['product_id']);
        }
        $this->handlefromto($from, $end);
        if (Arr::exists($query, 'page') && Arr::exists($query, 'page_size')) {
            $this->handlePaginate($query['page_size']);

            return $this->mas;
        }

        return $this->mas->get();
    }

    protected function handleProduct($bahan)
    {
        $id = explode(',', $bahan);
        $this->mas = $this->mas->whereIn('product_id', $id);
    }

    protected function handlePaginate($page_size = 10)
    {
        $this->mas = $this->mas->paginate($page_size);
    }

    protected function handlefromto($from, $to)
    {
        $this->mas = $this->mas->whereBetween('created_at', [$from, $to]);
    }
}
