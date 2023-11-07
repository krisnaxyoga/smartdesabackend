<html>
<head>
    <title>Laporan RKP</title>
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
{{-- onload="print()" --}}
<body onload="print()">
    <div style="padding-bottom: 2%">
        <center>
                <h4>RANCANGAN RENCANA KERJA PEMERINTAH DESA (RKP-DESA)</h4>
                <h4>TAHUN : {{$data['rkp']->tahun}}</h4>
        </center>
        <table>
            <tr>
                <td width="200px">DESA</td>
                <td width="20px">:</td>
                <td>{{$data['rkp']->nama_desa}}</td>
            </tr>
            <tr>
                <td>KECAMATAN</td>
                <td>:</td>
                <td>DENPASAR UTARA</td>
            </tr>
            <tr>
                <td>KABUPATEN</td>
                <td>:</td>
                <td>DENPASAR</td>
            </tr>
            <tr>
                <td>PROVINSI</td>
                <td>:</td>
                <td>BALI</td>
            </tr>
        </table>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th colspan="2">Bidang/ Jenis Kegiatan</th>
                <th rowspan="2">Lokasi</th>
                <th rowspan="2">Volume</th>
                <th rowspan="2">Sasaran/Manfaat</th>
                <th rowspan="2">Waktu Pelaksanaan</th>
                <th colspan="2">Biaya dan Sumber Pembiayaan</th>
                <th colspan="3">Pola Pelaksanaan</th>
                <th rowspan="2">Rencana Pelaksana Kegiatan</th>
            </tr>
            <tr>
                <th>Bidang Kegiatan</th>
                <th>Jenis Kegiatan</th>
                <th>Jumlah (Rp)</th>
                <th>Sumber</th>
                <th>Swakelola</th>
                <th>Kerjasama Antar Desa</th>
                <th>Kerjasama Pihak Ketiga</th>
            </tr>
        </thead>
        <tbody>
            <tr id="alpha">
                <td>a</td>
                <td>b</td>
                <td>c</td>
                <td>d</td>
                <td>e</td>
                <td>f</td>
                <td>g</td>
                <td>h</td>
                <td>i</td>
                <td>j</td>
                <td>k</td>
                <td>l</td>
                <td>m</td>
            </tr>
            @foreach ($data['bidang'] as $item)
            @php
                $count = 0;
            @endphp

            @if (count($item->activity) < 1)
            @else
                @if (count($item->activity) > 1)
                <tr>
                    <td rowspan="{{count($item->activity)+1}}">{{$loop->iteration}}</td>
                    <td rowspan="{{count($item->activity)+1}}">{{$item->nama_bidang}}</td>
                </tr>
                @else
                <tr>
                    <td rowspan="2">{{$loop->iteration}}</td>
                    <td rowspan="2">{{$item->nama_bidang}}</td>
                </tr>
                @endif

                    @foreach ($item->activity as $activity)
                    <tr>
                        @php
                            $count = $count + $activity->jumlah
                        @endphp
                        <td>{{$activity->nama_kegiatan}}</td>
                        <td>{{$activity->wilayah->dusun ?? 'NULL'}}</td>
                        <td>{{$activity->volume}}</td>
                        <td>{{$activity->manfaat}}</td>
                        <td>{{$activity->start_date}}</td>
                        <td>{{number_format($activity->jumlah,"0",",",".")}}</td>
                        <td>{{$activity->sumber_biaya}}</td>
                        <td>{{$activity->swakelola}}</td>
                        <td>{{$activity->kerjasama_antardesa}}</td>
                        <td>{{$activity->kerjasama_pihak_ketiga}}</td>
                        <td>{{$activity->rencana_pelaksana_kegiatan}}</td>
                    </tr>
                    @endforeach
                <tr>
                    <td colspan="7" style="text-align:right">Jumlah per Bidang {{$loop->iteration}}</td>
                    <td>{{number_format($count,"0",",",".")}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>


            @endif


            @endforeach
        </tbody>
    </table>
    <br><br>
    <table>
        <tr>
            <td></td>
            <td width="1000"></td>
            <td style="text-align:center;">Denpasar, {{ date_format($data['rkp']->created_at, "d/m/Y") }}</td>
        </tr>
        <tr>
            <td style="text-align:center;">Mengetahui :</td>
            <td>&nbsp;</td>
            <td style="text-align:center;">Disusun Oleh :</td>
        </tr>
        <tr>
            <td style="text-align:center;">Kepala Desa,</td>
            <td>&nbsp;</td>
            <td style="text-align:center;">Tim Penyusun RPJM Desa</td>
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
</body>
</html>
