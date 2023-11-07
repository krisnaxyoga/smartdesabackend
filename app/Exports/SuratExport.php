<?php

namespace App\Exports;

use App\Penduduk;
use App\PengajuanSurat;
use Illuminate\Contracts\View\View;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class SuratExport extends DefaultValueBinder implements WithCustomValueBinder, FromView, ShouldAutoSize
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * @return View
     */
    public function view(): View
    {
        $data = PengajuanSurat::select('*')
            ->where('dusun_id', $this->request->dusun_id)
            ->whereBetween('tanggal_cetak', [$this->request->start_date, $this->request->end_date])
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('exports.surat', [
            'data' => $data
        ]);
    }

    public function bindValue(Cell $cell, $value)
    {
        $columns = ['C', 'D', 'E'];

        if (is_numeric($value) && in_array($cell->getColumn(), $columns)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
