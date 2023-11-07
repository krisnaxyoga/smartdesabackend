<html>
<head>
    <title>Laporan RKP</title>
</head>
<style>
/* @font-face{
    font-family: Arial, Helvetica, sans-serif;
    src: url('theme/assets/font/bookman old style.ttf') format('truetype');
} */
*{
    font-size: 8pt !important
}
body{
    font-family: Arial, Helvetica, sans-serif;
    margin: 5% 50px;
}
#table {
    border-collapse: collapse;
    /* width: 100%; */
    width: 1247px;
}

#table td {
    border: 1px solid #111;
    padding: 4px;
}
#table th {
    border: 1px solid #111;
    font-size: 8px;
    padding: 4px;
}
#table #alpha{
    text-align: center;
    font-weight: bold;
    /* font-style: italic; */
}
@media print{
    @page {
        font-size: 8pt !important;
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
                <h4>RENCANA KERJA PEMERINTAH DESA</h4>
                <h4>TAHUN {{$data['rkp']->tahun}}</h4>
        </center>
        <table>
            <tr>
                <td width="120px"><b>DESA</b></td>
                <td width="20px"><b>:</b></td>
                <td><b>{{strtoupper($data['rkp']->nama_desa)}}</b></td>
            </tr>
            <tr>
                <td><b>KECAMATAN</b></td>
                <td><b>:</b></td>
                <td><b>{{strtoupper($data['rkp']->nama_kecamatan)}}</b></td>
            </tr>
            <tr>
                <td><b>KABUPATEN/KOTA</b></td>
                <td><b>:</b></td>
                <td><b>{{strtoupper($data['rkp']->nama_kabupaten)}}</b></td>
            </tr>
            <tr>
                <td><b>PROVINSI</b></td>
                <td><b>:</b></td>
                <td><b>{{strtoupper($data['rkp']->nama_propinsi)}}</b></td>
            </tr>
        </table>
    </div>
    <table id="table">
        <thead>
            <tr>
                <th width="30px" rowspan="2">KD</th>
                <th width="340px" colspan="2">BIDANG/SUB BIDANG/JENIS KEGIATAN</th>
                <th width="86px" rowspan="2">LOKASI <br>( RT / RW <br> DUSUN )</th>
                <th width="86px" rowspan="2">PERKIRAAN VOLUME</th>
                <th width="86px" rowspan="2">SASARAN / <br> MANFAAT</th>
                <th width="86px" rowspan="2">WAKTU <br> PELAKSANAAN</th>
                <th width="288px" colspan="2">PERKIRAAN BIAYA & SUMBERDANA</th>
                <th width="135px" colspan="3">POLA PELAKSANAAN</th>
                <th width="110px" rowspan="2">RENCANA PELAKSANAAN KEGIATAN</th>
            </tr>
            <tr>
                <th width="165px">BIDANG/SUB BIDANG</th>
                <th width="175px">JENIS KEGIATAN</th>
                <th width="174px">JUMLAH <br> (RUPIAH)</th>
                <th width="114px">SUMBER</th>
                <th width="45px">SWA<br>KELOLA</th>
                <th width="45px">KERJA<br>SAMA</th>
                <th width="45px">PIHAK<br>KETIGA</th>
            </tr>
        </thead>
        <tbody>
            <tr id="alpha">
                <td width="30px">1</td>
                <td width="165px">2</td>
                <td width="175px">3</td>
                <td width="86px">4</td>
                <td width="86px">5</td>
                <td width="86px">6</td>
                <td width="86px">7</td>
                <td width="164px">8</td>
                <td width="124px">9</td>
                <td width="45px">10</td>
                <td width="45px">11</td>
                <td width="45px">12</td>
                <td width="110px">13</td>
            </tr>

            @foreach($data['bidang'] as $item)
                <tr>
                    <td align=center><b>{{$item->kode_bidang}}</b></td>
                    <td colspan="2"><b>{{strtoupper($item->nama_bidang)}}</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @foreach($item->chaild as $sub_bidang)
                    @php
                        $idxSub = 0;
                        $count = 0;
                    @endphp
                    @foreach($sub_bidang->activity as $key=>$activity)
                        @php
                            $count = $count + $activity->jumlah;
                        @endphp
                        <tr>
                            <td></td>
                            @if($idxSub == 0)
                            <td valign="top" width="165px" rowspan="{{count($sub_bidang->activity)}}">{{$sub_bidang->nama_bidang}}</td>
                            @endif
                            <td valign="top">{{$activity->nama_kegiatan}}</td>
                            <td valign="top" width="86px">{{$activity->wilayah->dusun ?? 'NULL'}}</td>
                            <td valign="top" align=right>{{$activity->volume}}</td>
                            <td valign="top">{{$activity->manfaat}}</td>
                            <td valign="top">{{$activity->estimated_time}}</td>
                            <td valign="top" align=right>{{number_format($activity->jumlah,"0",",",".")}}</td>
                            <td valign="top">{{$activity->biaya->nama ?? 'NULL'}}</td>
                            <td valign="top" align=center><b>{{$activity->swakelola == 'ya' ? '✓' : ''}}</b></td>
                            <td valign="top" align=center><b>{{$activity->kerjasama_antardesa == 'ya' ? '✓' : '' }}</b></td>
                            <td valign="top" align=center><b>{{$activity->kerjasama_pihak_ketiga == 'ya' ? '✓' : ''}}</b></td>
                            <td valign="top">{{ strtoupper($activity->rencana_pelaksana_kegiatan) }}</td>
                        </tr>
                        @php
                            $idxSub++;
                        @endphp
                    @endforeach
                <tr>
                    <td colspan="7" style="text-align:right"><b>JUMLAH PERBIDANG</b></td>
                    <td align=right><b>{{number_format($count,"0",",",".")}}</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            @endforeach
            <tr>
                <td colspan="7" style="text-align:right"><b>JUMLAH TOTAL</b></td>
                <td align=right><b>{{number_format($data['grand_total'],"0",",",".")}}</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
