<?php

namespace Domain\Produksi\Actions;

use Carbon\Carbon;
use Domain\Bahan\Actions\CRUD\Keluar\CreateKeluarBahanAction;
use Domain\Product\Actions\CRUD\Masuk\CreateMasukProductAction;
use Illuminate\Support\Facades\DB;
use Infra\Produksi\Models\Product;
use Infra\Produksi\Models\Production\Production;
use Infra\Shared\Foundations\Action;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ChangeStatusProduksiAction extends Action
{
    protected $produksi;

    protected $data;

    protected $method;

    public function execute(Production $prod, $status, $data, $method)
    {
        $this->data = $data;
        $this->method = $method;
        $this->produksi = $prod;
        $methodName = 'changeTo'.$status;
        if (! method_exists($this, $methodName)) {
            throw new BadRequestException('Status tidak bisa di ubah');
        }
        DB::beginTransaction();
        $this->$methodName();
        DB::commit();

        return $this->produksi;
    }

    protected function changeToProses()
    {
        if ($this->produksi->status == 'menyiapkan') {
            $this->handleHitungPengeluaran($this->produksi->product, $this->produksi);
            $this->produksi->status = 'Proses';
            $this->produksi->save();

            return true;
        }
        throw new BadRequestException('Salah status');
    }

    protected function changeToCheck()
    {
        if ($this->produksi->status == 'Proses' && $this->method == 'PUT' && ! empty($this->data)) {
            $this->produksi->status = 'Completed';
            $this->produksi->jumlah = $this->data['jumlah'];
            $this->produksi->tanggal_selesai = Carbon::now();
            $this->produksi->save();
            $this->handleMasukBarang($this->produksi);

            return true;
        }
        throw new BadRequestException('tidak bisa melakukan check');
    }

    protected function changeToFail()
    {
        if ($this->produksi->status == 'Proses') {
            $this->produksi->status = 'Failure';
            $this->produksi->tanggal_selesai = Carbon::now();
            $this->produksi->save();

            return true;
        }
        throw new BadRequestException('tidak bisa melakukan check');
    }

    protected function handleMasukBarang(Production $produksi)
    {
        $data['jumlah'] = $produksi->jumlah;
        $data['product_id'] = $produksi->product_id;
        $data['nama'] = $produksi->nama;
        $data['keterangan'] = 'Produksi-'.$produksi->product->name.'-'.$produksi->tanggal_selesai;
        CreateMasukProductAction::resolve()->execute($produksi->product->id, $data);
    }

    protected function handleHitungPengeluaran(Product $prod, Production $jum)
    {
        $resep = $prod->recipe()->get();
        foreach ($resep as $item) {
            $data['nama'] = $jum->nama;
            $data['keterangan'] = 'produksi-'.$prod->name;
            $data['jumlah'] = $item->jumlah * $jum->jumlah;
            $data['bahan_id'] = $item->bahan_id;
            $keluar = CreateKeluarBahanAction::resolve()->execute($item->bahan_id, $data);
        }
    }
}
