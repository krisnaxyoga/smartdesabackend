<table>
    <thead>
        <tr>
            <th width="300"><strong>{{ strtoupper('NIK') }}</strong></th>
            <th><strong>{{ strtoupper('Nama') }}</strong></th>
            <th width="300"><strong>{{ strtoupper('No. KK') }}</strong></th>
            <th><strong>{{ strtoupper('Jenis Kelamin') }}</strong></th>
            <th><strong>{{ strtoupper('Status Hubungan Dalam Keluarga') }}</strong></th>
            <th><strong>{{ strtoupper('Tempat Lahir') }}</strong></th>
            <th><strong>{{ strtoupper('Tanggal Lahir') }}</strong></th>
            <th><strong>{{ strtoupper('Waktu Lahir') }}</strong></th>
            <th><strong>{{ strtoupper('Tempat Dilahirkan') }}</strong></th>
            <th><strong>{{ strtoupper('Jenis Kelahiran') }}</strong></th>
            <th><strong>{{ strtoupper('Penolong Kelahiran') }}</strong></th>
            <th><strong>{{ strtoupper('Golongan Darah') }}</strong></th>
            <th><strong>{{ strtoupper('Alamat Sebelumnya') }}</strong></th>
            <th><strong>{{ strtoupper('Alamat Sekarang') }}</strong></th>
            <th><strong>{{ strtoupper('Telepon') }}</strong></th>
            <th><strong>{{ strtoupper('Agama') }}</strong></th>
            <th><strong>{{ strtoupper('Status') }}</strong></th>
            <th><strong>{{ strtoupper('Suku') }}</strong></th>
            <th><strong>{{ strtoupper('KTP Elektronik') }}</strong></th>
            <th><strong>{{ strtoupper('Status KTP Elektronik') }}</strong></th>
            <th><strong>{{ strtoupper('Nama Ayah') }}</strong></th>
            <th><strong>{{ strtoupper('NIK Ayah') }}</strong></th>
            <th><strong>{{ strtoupper('Nama Ibu') }}</strong></th>
            <th><strong>{{ strtoupper('NIK Ibu') }}</strong></th>
            <th><strong>{{ strtoupper('Akta Lahir') }}</strong></th>
            <th><strong>{{ strtoupper('Akta Perkawinan') }}</strong></th>
            <th><strong>{{ strtoupper('Tanggal Perkawinan') }}</strong></th>
            <th><strong>{{ strtoupper('Akta Perceraian') }}</strong></th>
            <th><strong>{{ strtoupper('Tanggal Perceraian') }}</strong></th>
            <th><strong>{{ strtoupper('Tanggal Akhir Paspor') }}</strong></th>
            <th><strong>{{ strtoupper('Anak Ke') }}</strong></th>
            <th><strong>{{ strtoupper('Berat Lahir') }}</strong></th>
            <th><strong>{{ strtoupper('Panjang Lahir') }}</strong></th>
            <th><strong>{{ strtoupper('Pendidikan Sesuai KK') }}</strong></th>
            <th><strong>{{ strtoupper('Pendidikan Sekarang') }}</strong></th>
            <th><strong>{{ strtoupper('Pekerjaan') }}</strong></th>
            <th><strong>{{ strtoupper('Kewarganegaraan') }}</strong></th>
            <th><strong>{{ strtoupper('Dusun') }}</strong></th>
            <th><strong>{{ strtoupper('Cacat') }}</strong></th>
            <th><strong>{{ strtoupper('Sakit Menahun') }}</strong></th>
            <th><strong>{{ strtoupper('Cara KB') }}</strong></th>
            <th><strong>{{ strtoupper('Koordinat') }}</strong></th>
            <th><strong>{{ strtoupper('RT/RW') }}</strong></th>
            <th><strong>{{ strtoupper('Terakhir Diubah') }}</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach($penduduk as $data)
        <tr>
            <td>{{ $data->nik ? $data->nik : '' }}</td>
            <td>{{ $data->nama ? str_replace('=','',$data->nama) : '' }}</td>
            <td>{{ $data->no_kk ? $data->no_kk : '' }}</td>
            <td>{{ $data->jenis_kelamin ? $data->jenis_kelamin : '' }}</td>
            <td>{{ $data->hubungan ? $data->hubungan : '' }}</td>
            <td>{{ $data->tempatlahir ? $data->tempatlahir : '' }}</td>
            <td>{{ $data->tanggallahir ? date('Y-m-d', strtotime($data->tanggallahir)) : '-' }}</td>
            <td>{{ $data->waktu_lahir ? $data->waktu_lahir : '' }}</td>
            <td>{{ $data->tempat_dilahirkan ? $data->tempat_dilahirkan : '' }}</td>
            <td>{{ $data->jenis_kelahiran ? $data->jenis_kelahiran : '' }}</td>
            <td>{{ $data->penolog_kelahiran ? $data->penolog_kelahiran : '' }}</td>
            <td>{{ $data->golongan_darah ? $data->golongan_darah : '' }}</td>
            <td>{{ $data->alamat_sebelumnya ? $data->alamat_sebelumnya : '' }}</td>
            <td>{{ $data->alamat_sekarang ? $data->alamat_sekarang : '' }}</td>
            <td>{{ $data->telepon ? $data->telepon : '' }}</td>
            <td>{{ $data->agama ? $data->agama : '' }}</td>
            <td>{{ $data->kawin ? $data->kawin : '' }}</td>
            <td>{{ $data->suku ? $data->suku : '' }}</td>
            <td>{{ $data->ktp_el ? $data->ktp_el : '' == 0 ? 'YA' : 'TIDAK' }}</td>
            <td>{{ $data->status_rekam ? $data->status_rekam : '' }}</td>
            <td>{{ $data->nama_ayah ? str_replace('=','',$data->nama_ayah) : '' }}</td>
            <td>{{ $data->ayah_nik ? $data->ayah_nik : '' }}</td>
            <td>{{ $data->nama_ibu ? str_replace('=','',$data->nama_ibu) : '' }}</td>
            <td>{{ $data->ibu_nik ? $data->ibu_nik : '' }}</td>
            <td>{{ $data->akta_lahir ? $data->akta_lahir : '' }}</td>
            <td>{{ $data->akta_perkawinan ? $data->akta_perkawinan : '' }}</td>
            <td>{{ $data->tanggalperkawinan ? $data->tanggalperkawinan : '' }}</td>
            <td>{{ $data->akta_perceraian ? $data->akta_perceraian : '' }}</td>
            <td>{{ $data->tanggalperceraian ? $data->tanggalperceraian : '' }}</td>
            <td>{{ $data->tanggal_akhir_paspor ? $data->tanggal_akhir_paspor : '' }}</td>
            <td>{{ $data->kelahiran_anak_ke ? $data->kelahiran_anak_ke : '' }}</td>
            <td>{{ $data->berat_lahir ? $data->berat_lahir : '' }} kg</td>
            <td>{{ $data->panjang_lahir ? $data->panjang_lahir : '' }} cm</td>
            <td>{{ $data->pendidikan_kk ? $data->pendidikan_kk : '' }}</td>
            <td>{{ $data->pendidikan ? $data->pendidikan : '' }}</td>
            <td>{{ $data->pekerjaan ? $data->pekerjaan : '' }}</td>
            <td>{{ $data->warganegara ? $data->warganegara : '' }}</td>
            <td>{{ $data->dusun ? $data->dusun : '' }}</td>
            <td>{{ $data->cacat ? $data->cacat : '' }}</td>
            <td>{{ $data->sakit_menahun ? $data->sakit_menahun : '' }}</td>
            <td>{{ $data->cara_kb ? $data->cara_kb : '' }}</td>
            <td>
                @if ($data->lat && $data->lng)
                {{ $data->lat ? $data->lat : '' }}, {{ $data->lng ? $data->lng : '' }}
                @endif
            </td>
            <td>{{ $data->rt ? $data->rt : '000' }}/{{ $data->rw ? $data->rw : '000' }}</td>
            <td>{{ $data->updated_at ? date('Y-m-d', strtotime($data->updated_at)) : '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>