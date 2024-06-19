<?php

namespace Domain\Product\Actions\CRUD\Keluar;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Infra\Produksi\Models\Keluar\KeluarProduct;
use Infra\Shared\Foundations\Action;

class GetKeluarProductAction extends Action
{
    protected $kel;

    public function execute($query)
    {
        $this->kel = KeluarProduct::query();
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

            return $this->kel;
        }

        return $this->kel->get();
    }

    protected function handleProduct($bahan)
    {
        $id = explode(',', $bahan);
        $this->kel = $this->kel->whereIn('product_id', $id);
    }

    protected function handlePaginate($page_size)
    {
        $this->kel = $this->kel->paginate($page_size);
    }

    protected function handlefromto($from, $to)
    {
        $this->kel = $this->kel->whereBetween('created_at', [$from, $to]);
    }
}
