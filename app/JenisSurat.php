<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisSurat extends Model
{
    //
    protected $table = 'jenis_surat';

    protected $fillable = [
        'judul','is_mobile'
    ];

    protected $appends = [
        'fieldsets'
    ];

    protected $casts  = [
        'tipe' => 'array',
    ];

    public function getLastNumber($id)
    {
        $data = PengajuanSurat::select('nomor_surat')->where('jenis_surat_id',$id)->orderBy('created_at','DESC')->first();
        if($data)
            return $data->nomor_surat;
        else 
            return "";
    }

    public function getFieldsetsAttribute()
    {
        $data = [];

        if(is_array($this->tipe) && count($this->tipe) > 0) {
            foreach ($this->tipe as $key) {
                /**
                 * Tipe : 
                 * 1 - Keperluan
                 * 2 - Periode
                 * 3 - Jenis Acara
                 * 4 - Periode Date Time
                 */
                switch ($key) {
                    case 1:
                        $data[] = 'keperluan';
                        break;
                    
                    case 2:
                        // $data[] = 'berlaku_dari';
                        // $data[] = 'berlaku_sampai';
                        break;
                    case 3:
                        $data[] =  'jenis_acara';
                        break;
                    case 4:
                        $data[] = 'berlaku_dari';
                        $data[] = 'berlaku_sampai';
                        break;
                    
    
                    default:
                        # code...
                        break;
                }
            }
        }
        return $data;
    }
    
}
