<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Imports\Template\TemplateSheetImport;
class PendudukImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            new TemplateSheetImport()
        ];
    }
}
