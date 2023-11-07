<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>No. Surat</th>
            <th>No. Surat Kadus</th>
            <th>NIK</th>
            <th>Pemohon</th>
            <th>Jenis Surat</th>
            <th width="20%">Keperluan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $d)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ date('j M Y', strtotime($d->tanggal_cetak)) }}</td>
            <td>{{ $d->nomor_surat }}</td>
            <td>{{ $d->no_surat_pengantar }}</td>
            <td>{{ $d->penduduk->nik }}</td>
            <td>{{ $d->penduduk->nama }}</td>
            <td>{{ $d->jenisSurat->judul }}</td>
            <td>{{ $d->keperluan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>