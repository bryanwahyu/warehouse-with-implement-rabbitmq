<?php

namespace App\Imports\Bahan;

use Domain\Bahan\Actions\CRUD\Keluar\CreateKeluarBahanAction;
use Domain\Bahan\Actions\CRUD\Masuk\CreateMasukBahanAction;
use Illuminate\Support\Collection;
use Infra\Bahan\Models\Bahan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class StokOpnameImport implements ToModel, WithHeadingRow
{
    /**
     * @param  Collection  $collection
     */
    public function model(array $row)
    {
        $bah = Bahan::where('sku', $row['code'])->first();
        if (! $bah) {
            throw new BadRequestException(message: 'Bahan sku tidak di temukan');
        }
        $total_stok = $bah->stok - $row['stok'];

        $data['nama'] = $row['nama_pegawai'];
        $data['keterangan'] = 'Stok-Opname';
        if ($total_stok < 0) {
            $total_stok = $row['stok'] - $bah->stok;
            $data['jumlah'] = $total_stok;
            $datamasuk = CreateMasukBahanAction::resolve()->execute($bah->id, $data);

            return $datamasuk;
        }
        $data['jumlah'] = $total_stok;
        $datakeluar = CreateKeluarBahanAction::resolve()->execute($bah->id, $data);

        return $datakeluar;
    }
}
