<?php

namespace Domain\Bahan\Actions\Import;

use App\Imports\Bahan\MasukKeluarImport;
use Infra\Bahan\Models\Bahan;
use Infra\Shared\Foundations\Action;
use Infra\Shared\Services\RabbitMQService;
use Maatwebsite\Excel\Facades\Excel;

class ImportMasukKeluarAction extends Action
{
    public function execute(Bahan $bah, $file)
    {
        $rows = Excel::import(new MasukKeluarImport($bah), $file);

        $rabbitMQService = new RabbitMQService();
        $message = json_encode(['message' => 'ada yang melakukan import']);
        $rabbitMQService->publish($message);
    }
}
