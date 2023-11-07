<?php
namespace App\Exports\PendudukTemplate\Sheets;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\PendudukWarganegara;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendudukStatusKewarganegaraanSheet implements FromQuery, WithTitle, WithHeadings, ShouldAutoSize
{

    public function __construct()
    {

    }

    /**
     * @return Builder
     */
    public function query()
    {
        return PendudukWarganegara
            ::query()
            ->select('id','nama');
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Format Warga Kenegaraan';
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama'
        ];
    }
}
