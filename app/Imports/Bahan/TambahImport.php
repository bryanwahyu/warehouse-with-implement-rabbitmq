<?php

namespace App\Imports\Bahan;

use Infra\Bahan\Models\Bahan;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class TambahImport implements ToModel, WithBatchInserts, WithChunkReading, WithHeadingRow
{
    use RemembersRowNumber;

    public function model(array $row)
    {

        if (Bahan::where('sku', $row['code'])->first()) {
            throw new BadRequestException('data SKU sudah ada di row ke-'.$this->getRowNumber());
        }

        return new Bahan([
            'sku' => $row['code'],
            'name' => $row['nama_bahan'],
            'category_id' => $row['category_id'],
            'satuan_id' => $row['satuan_id'],
            'is_count' => $row['bisa_di_hitungtruefalse'],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
