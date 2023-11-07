<?php
namespace App\Exports\PendudukTemplate;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\PendudukTemplate\Sheets\PendudukAgamaSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukSexSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukStatusHubunganKawinSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukStatusHubunganKeluargaSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukPendidikanSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukPekerjaanSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukDusunSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukTemplateSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukGolonganDarahSheet;
use App\Exports\PendudukTemplate\Sheets\KetentuanSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukStatusSheet;
use App\Exports\PendudukTemplate\Sheets\PendudukStatusKewarganegaraanSheet;

class TemplateExport implements WithMultipleSheets
{
    use Exportable;

    public function __construct()
    {

    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];


        $sheetTemplate = new PendudukTemplateSheet();
        $sheets[] = $sheetTemplate;
        $sheets[] = new KetentuanSheet();
        $sheets[] = new PendudukAgamaSheet();
        $sheets[] = new PendudukGolonganDarahSheet();
        $sheets[] = new PendudukStatusHubunganKeluargaSheet();
        $sheets[] = new PendudukStatusHubunganKawinSheet();
        $sheets[] = new PendudukPendidikanSheet();
        $sheets[] = new PendudukPekerjaanSheet();
        $sheets[] = new PendudukDusunSheet();
        $sheets[] = new PendudukSexSheet();
        $sheets[] = new PendudukStatusSheet();
        $sheets[] = new PendudukStatusKewarganegaraanSheet();


        return $sheets;
    }
}
