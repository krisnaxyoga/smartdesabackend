<?php
namespace App\Exports\PendudukTemplate\Sheets;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\PendudukKawin;
class PendudukStatusHubunganKawinSheet implements FromQuery, WithTitle, WithHeadings, ShouldAutoSize
{

    public function __construct()
    {

    }

    /**
     * @return Builder
     */
    public function query()
    {
        return PendudukKawin
            ::query()
            ->select('id','nama');
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Format Status Kawin';
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