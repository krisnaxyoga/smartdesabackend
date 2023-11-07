<?php

namespace App\Imports\Template;

use App\Keluarga;
use App\Penduduk;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TemplateSheetImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // $kk = Keluarga::where('no_kk',$row['no_kk'])->first();
            $kk = Keluarga::firstOrCreate(
                [
                    'no_kk' => (int) $row['no_kk']
                ],
                [
                    'nik_kepala' => (int) $row['nik'],
                    'id_cluster' => (int) $row['dusun'],
                ]
            );
            // dd($kk->id);

            if ((int) $row['shdk'] == '1') {
                $kk->update([
                    'nik_kepala' => (int) $row['nik'],
                    'id_cluster' => (int) $row['dusun'],
                ]);
            }

            Penduduk::firstOrCreate(
                [
                    'nik' => $row['nik']
                ],
                [
                    'nama' => $row['nama'],
                    'kk_level' => (int) $row['shdk'],
                    'id_kk' => $kk->id,
                    'sex' => $row['jk'], //== "Pr" ? '2' : '1',
                    'tempatlahir' => $row['tmpt_lhr'],
                    'tanggallahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lhr']),
                    'agama_id' => (int) $row['agama'],
                    'pendidikan_kk_id' => (int) $row['pddk_akhir'],
                    'pekerjaan_id' => (int) $row['pekerjaan'],
                    'status_kawin_id' => (int) $row['status_kawin'],
                    'warganegara_id' => (int) $row['warga_kenegaraan'],
                    'nama_ayah' => $row['nama_ayah'],
                    'nama_ibu' => $row['nama_ibu'],
                    'dusun_id' => (int) $row['dusun'],
                    'golongan_darah_id' => (int) $row['gdr'],
                    'alamat_sekarang' => $row['alamat'],
                    'status' => (int) $row['status'],
                    'akta_lahir' => $row['no_akta_lahir'],
                    'akta_perkawinan' => $row['no_akta_kwn'],
                    'akta_perceraian' => $row['no_akta_crai'],
                ]
            );
        }
    }

    public function chunkSize(): int
    {
        return 200;
    }
}
