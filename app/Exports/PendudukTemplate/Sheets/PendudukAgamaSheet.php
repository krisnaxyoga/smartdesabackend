<?php
namespace App\Exports\PendudukTemplate\Sheets;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\PendudukAgama;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PendudukAgamaSheet implements FromQuery, WithTitle, WithHeadings, ShouldAutoSize
{

    public function __construct()
    {

    }

    /**
     * @return Builder
     */
    public function query()
    {
        return PendudukAgama
            ::query()
            ->select('id','nama');
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Format Agama';
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