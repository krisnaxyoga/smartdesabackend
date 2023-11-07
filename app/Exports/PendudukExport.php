<?php

namespace App\Exports;

use App\Penduduk;

use Illuminate\Contracts\View\View;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

use PhpOffice\PhpSpreadsheet\Cell\Cell;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;

class PendudukExport extends DefaultValueBinder implements WithCustomValueBinder, FromView, ShouldAutoSize
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
    { //memanggil data yang akan di export dari database
        $data = Penduduk::select(
            'penduduk.nama',
            'penduduk.kk_level',
            'penduduk.nik',
            'penduduk.tempatlahir',
            'penduduk.tanggallahir',
            'penduduk.ayah_nik',
            'penduduk.ibu_nik',
            'penduduk.sex',
            'penduduk.nama_ayah',
            'penduduk.nama_ibu',
            'penduduk.alamat_sebelumnya',
            'penduduk.alamat_sekarang',
            'penduduk.akta_lahir',
            'penduduk.akta_perkawinan',
            'penduduk.tanggalperkawinan',
            'penduduk.akta_perceraian',
            'penduduk.tanggalperceraian',
            'penduduk.telepon',
            'penduduk.tanggal_akhir_paspor',
            // 'penduduk.no_kk_sebelumnya',
            'penduduk.ktp_el',
            'penduduk.waktu_lahir',
            'penduduk.kelahiran_anak_ke',
            'penduduk.berat_lahir',
            'penduduk.panjang_lahir',
            'penduduk.created_at',
            'penduduk.updated_at',
            'keluarga.no_kk AS no_kk',
            'penduduk_agama.nama AS agama',
            'penduduk_hubungan.nama AS hubungan',
            'penduduk_pendidikan_kk.nama AS pendidikan_kk',
            'penduduk_pendidikan.nama AS pendidikan',
            'penduduk_pekerjaan.nama AS pekerjaan',
            'penduduk_kawin.nama AS kawin',
            'penduduk_warganegara.nama AS warganegara',
            'wilayah.dusun AS dusun',
            'cacat.nama AS cacat',
            'sakit_menahun.nama AS sakit_menahun',
            'cara_kb.nama AS cara_kb',
            'penduduk_sex.nama AS jenis_kelamin',
            'ktp_status.nama AS ktp_status',
            'tempat_dilahirkan.name AS tempat_dilahirkan',
            'jenis_kelahiran.nama AS jenis_kelahiran',
            'penolong_kelahiran.nama AS penolong_kelahiran',
            'golongan_darah.nama AS golongan_darah',
            'suku.nama AS suku',
            'penduduk_map.lat AS lat',
            'penduduk_map.lng AS lng',
            'wilayah.rt AS rt',
            'wilayah.rw AS rw'
        )
            ->leftJoin('keluarga', 'keluarga.id', '=', 'penduduk.id_kk')
            ->leftJoin('penduduk_agama', 'penduduk_agama.id', '=', 'penduduk.agama_id')
            ->leftJoin('penduduk_pendidikan_kk', 'penduduk_pendidikan_kk.id', '=', 'penduduk.pendidikan_kk_id')
            ->leftJoin('penduduk_hubungan', 'penduduk_hubungan.id', '=', 'penduduk.kk_level')
            ->leftJoin('penduduk_pendidikan', 'penduduk_pendidikan.id', '=', 'penduduk.pendidikan_sedang_id')
            ->leftJoin('penduduk_pekerjaan', 'penduduk_pekerjaan.id', '=', 'penduduk.pekerjaan_id')
            ->leftJoin('penduduk_kawin', 'penduduk_kawin.id', '=', 'penduduk.status_kawin_id')
            ->leftJoin('penduduk_warganegara', 'penduduk_warganegara.id', '=', 'penduduk.warganegara_id')
            ->leftJoin('penduduk_map', 'penduduk.id', '=', 'penduduk_map.penduduk_id')
            ->leftJoin('wilayah', 'wilayah.id', '=', 'penduduk.dusun_id')
            ->leftJoin('cacat', 'cacat.id', '=', 'penduduk.cacat_id')
            ->leftJoin('penduduk_sex', 'penduduk_sex.id', '=', 'penduduk.sex')
            ->leftJoin('sakit_menahun', 'sakit_menahun.id', '=', 'penduduk.sakit_menahun_id')
            ->leftJoin('cara_kb', 'cara_kb.id', '=', 'penduduk.cara_kb_id')
            ->leftJoin('ktp_status', 'ktp_status.id', '=', 'penduduk.status_rekam_id')
            ->leftJoin('tempat_dilahirkan', 'tempat_dilahirkan.id', '=', 'penduduk.tempat_dilahirkan_id')
            ->leftJoin('jenis_kelahiran', 'jenis_kelahiran.id', '=', 'penduduk.jenis_kelahiran_id')
            ->leftJoin('penolong_kelahiran', 'penolong_kelahiran.id', '=', 'penduduk.penolong_kelahiran_id')
            ->leftJoin('golongan_darah', 'golongan_darah.id', '=', 'penduduk.golongan_darah_id')
            ->leftJoin('suku', 'suku.id', '=', 'penduduk.suku_id');

        if ($this->request->dusun_id !== "ALL") {
            $data = $data->where('penduduk.dusun_id', $this->request->dusun_id); //mengatur data sesuai dusun yang akan di export
        }

        return view('exports.penduduk', [
            'penduduk' => $data->get()
        ]);
    }

    public function bindValue(Cell $cell, $value) //mengatur excel yang mau di tambahkan data yang di export tadi
    {
        $columns = ['A', 'C', 'D', 'T', 'V'];

        if (is_numeric($value) && in_array($cell->getColumn(), $columns)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }
}
