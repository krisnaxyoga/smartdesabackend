<html>
<head>
    <title>Laporan RAB</title>
</head>
<style>
@font-face{
    font-family: 'Bookman Old Style';
    src: url('theme/assets/font/bookman old style.ttf') format('truetype');
}
*{
    font-size: 12pt !important
}
body{
    font-family: 'Bookman Old Style';
    margin: 5% 50px;;
}
#table {
    border-collapse: collapse;
    width: 100%;
}

#table td, #table th {
    border: 1px solid #111;
    padding: 8px;
}
#table #alpha{
    text-align: center;
    font-style: italic;
}
@media print{
    @page {
        font-size: 10pt !important;
        size: 33cm 21.6cm;
        margin: 20mm 5mm 20mm 5mm;
        /* change the margins as you want them to be. */
    }
}

</style>
<body onload="print()">
    <div style="padding-bottom: 2%">
        <center>
                <h4>DAFTAR GAGASAN DUSUN/ KELOMPOK : {{$data['usulan']->pengusul}}</h4>
        </center>
        <table style="width:100%;">
            <tr>
                <td width="200px">DESA</td>
                <td width="20px">:</td>
                <td>{{$data['usulan']->nama_desa}}</td>
            </tr>
            <tr>
                <td>KECAMATAN</td>
                <td>:</td>
                <td>{{$data['desa']->nama_kecamatan}}</td>
            </tr>
            <tr>
                <td>KABUPATEN</td>
                <td>:</td>
                <td>{{$data['desa']->nama_kabupaten}}</td>
            </tr>
            <tr>
                <td>PROVINSI</td>
                <td>:</td>
                <td>{{$data['desa']->nama_propinsi}}</td>
            </tr>
        </table>
        <br>
        <table id="table">
            <thead>
                <tr>
                    <th rowspan="2" width="50">No</th>
                    <th rowspan="2" width="250">Gagasan Kegiatan</th>
                    <th rowspan="2" width="150">Lokasi Kegiatan</th>
                    <th rowspan="2" width="100">Prakiraan Volume</th>
                    <th rowspan="2" width="50">Satuan</th>
                    <th colspan="3" width="100">Penerima Manfaat</th>
                </tr>
                <tr>
                    <th>LK</th>
                    <th>PR</th>
                    <th>A-RTM</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['kegiatan'] as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->nama_kegiatan}}</td>
                        <td>{{$item->lokasi}}</td>
                        <td>{{$item->volume}}</td>
                        <td>{{$item->satuan}}</td>
                        <td>{{$item->penerima_lk}}</td>
                        <td>{{$item->penerima_pr}}</td>
                        <td>{{$item->penerima_artm}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <br><br>
        <table>
            <tr>
                <td style="text-align:center;">Mengetahui :</td>
                <td width="900"></td>
                <td width="400" style="text-align:center;">Desa {{$data['usulan']->nama_desa}}, {{ date_format($data['usulan']->created_at, "d/m/Y") }}</td>
            </tr>
            <tr>
                <td style="text-align:center;">Kepala Desa,</td>
                <td>&nbsp;</td>
                <td style="text-align:center;">Ketua Tim Penyusun RPJM Desa</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td style="text-align:center;">(..............................................)</td>
                <td>&nbsp;</td>
                <td style="text-align:center;">(..............................................)</td>
            </tr>
        </table>
    </div>
</body>
</html>
