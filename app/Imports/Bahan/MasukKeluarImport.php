<?php

namespace App\Imports\Bahan;

use Carbon\Carbon;
use Domain\Bahan\Actions\CRUD\Keluar\CreateKeluarBahanAction;
use Domain\Bahan\Actions\CRUD\Masuk\CreateMasukBahanAction;
use Infra\Bahan\Models\Bahan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasukKeluarImport implements ToModel, WithHeadingRow
{
    protected $bah;

    public function __construct(Bahan $bah)
    {
        $this->bah = $bah;
    }

    public function model(array $row)
    {
        if ($row['tipe'] == 'masuk') {
            $data = [
                'nama' => $row['nama'],
                'created_at' => Carbon::parse($row['tanggaldd_mm_yyyy']),
                'jumlah' => $row['jumlah'],
                'keterangan' => $row['keterangan'],
            ];
            $masuk = CreateMasukBahanAction::resolve()->execute($this->bah->id, $data);

            return $masuk;
        }
        if ($row['tipe'] == 'keluar') {
            $data = [
                'nama' => $row['nama'],
                'created_at' => Carbon::parse($row['tanggaldd_mm_yyyy']),
                'jumlah' => $row['jumlah'],
                'keterangan' => $row['keterangan'],
            ];
            $keluar = CreateKeluarBahanAction::resolve()->execute($this->bah->id, $data);

            return $keluar;
        }
    }
}
