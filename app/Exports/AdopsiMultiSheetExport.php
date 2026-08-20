<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdopsiMultiSheetExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new \App\Exports\Adopsi\RingkasanSheet(),
            new \App\Exports\Adopsi\PesananSheet(),
            new \App\Exports\Adopsi\PohonSheet(),
            new \App\Exports\Adopsi\MonitoringSheet(),
        ];
    }
}
