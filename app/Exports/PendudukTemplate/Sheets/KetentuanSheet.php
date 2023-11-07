<?php
namespace App\Exports\PendudukTemplate\Sheets;

use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Ketentuan;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\FromCollection;

class KetentuanSheet implements FromCollection, WithTitle, ShouldAutoSize
{

    public function __construct()
    {

    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return collect([
            [
                "1",
                "Terlampir 6 Sheet tambahan yang berisi daftar pilihan sesuai dengan nama sheet yang tertera"
            ],
            [
                "2",
                "Pada masing masing kolom yang memiliki format sheet HANYA MENCANTUMKAN ID saja, bukan nilai berupa teks"
            ],
            [
                "3",
                "Lakukan pemecahan data dengan mengisi maksimal 400 row per upload"
            ],
            [
                "Contoh : ",
                "Pada kolom Agama , bila beragama ISLAM silahkan ganti menjad 1, bila beragama KRISTEN silahkan ganti 2, dan seterusnya mengikuti format yang telah disediakan "
            ],
            [
                "Catatan : ",
                "Pada kolom JK , untuk jenis Kelamin LAKI-LAKI di ganti menjadi 1, sedangkan PEREMPUAN di ganti menjadi 2"
            ],


        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'KETENTUAN';
    }

    // /**
    //  * @return array
    //  */
    // public function headings(): array
    // {
    //     return [
    //         'No',
    //         'Nama'
    //     ];
    // }
}
