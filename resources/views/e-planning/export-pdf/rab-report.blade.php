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
                <h4>RANCANGAN ANGGARAN BIAYA (RAB)</h4>
        </center>
        <table style="width:100%;">
            <tr>
                <td width="200px">DESA</td>
                <td width="20px">:</td>
                <td>{{$data['rab']->nama_desa}}</td>
            </tr>
            <tr>
                <td>KECAMATAN</td>
                <td>:</td>
                <td>DENPASAR UTARA</td>
                <td width="10%"></td>
                <td>No. RAB</td>
                <td>:</td>
                <td>{{$data['rab']->no_rab}}</td>
            </tr>
            <tr>
                <td>KABUPATEN</td>
                <td>:</td>
                <td>DENPASAR</td>
                <td width="10%"></td>
                <td>BIDANG</td>
                <td>:</td>
                <td>{{$data['rab']->nama_bidang}}</td>
            </tr>
            <tr>
                <td>PROVINSI</td>
                <td>:</td>
                <td>BALI</td>
                <td width="10%"></td>
                <td>KEGIATAN</td>
                <td>:</td>
                <td>{{$data['rab']->nama_kegiatan}}</td>
            </tr>
        </table>
        <br>
        <table id="table">
            <thead>
                <tr>
                    <th width="250">URAIAN</th>
                    <th>Volume</th>
                    <th>Satuan</th>
                    <th>Harga Satuan (Rp)</th>
                    <th>Jumlah Total (Rp)</th>
                    <th width="150">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr id="alpha">
                    <td>a</td>
                    <td>b</td>
                    <td>c</td>
                    <td>d</td>
                    <td>e = b x d</td>
                    <td>f</td>
                </tr>
                <tr>
                    <td colspan="6"><b>1. BAHAN</b></td>
                </tr>
                @php
                    $count_a = 0;
                    $count_b = 0;
                    $count_c = 0;
                @endphp
                @foreach ($data['uraian'] as $item)
                    @if ($item->kategori_uraian == "Bahan")
                    @php
                        $count_a = $count_a + $item->jumlah_total;
                    @endphp
                        <tr>
                            <td>{{$item->nama_uraian}}</td>
                            <td>{{$item->volume}}</td>
                            <td>{{$item->satuan}}</td>
                            <td style="text-align:right">Rp. {{number_format($item->harga_satuan,"0",",",".")}}</td>
                            <td style="text-align:right">Rp. {{number_format($item->jumlah_total,"0",",",".")}}</td>
                            <td>{{$item->keterangan}}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right">Sub Total 1)</td>
                    <td style="text-align:right">Rp. {{number_format($count_a,"0",",",".")}}</td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="6"><b>2. ALAT</b></td>
                </tr>
                @foreach ($data['uraian'] as $item)
                    @if ($item->kategori_uraian == "Alat")
                    @php
                        $count_b = $count_b + $item->jumlah_total;
                    @endphp
                        <tr>
                            <td>{{$item->nama_uraian}}</td>
                            <td>{{$item->volume}}</td>
                            <td>{{$item->satuan}}</td>
                            <td style="text-align:right">Rp. {{number_format($item->harga_satuan,"0",",",".")}}</td>
                            <td style="text-align:right">Rp. {{number_format($item->jumlah_total,"0",",",".")}}</td>
                            <td>{{$item->keterangan}}</td>
                        </tr>
                    @endif
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right">Sub Total 2)</td>
                    <td style="text-align:right">Rp. {{number_format($count_b,"0",",",".")}}</td>
                    <td></td>
                </tr>
                <div>
                    <tr>
                        <td colspan="6"><b>3. UPAH</b></td>
                    </tr>
                    @foreach ($data['uraian'] as $item)
                        @if ($item->kategori_uraian == "Upah")
                        @php
                            $count_c = $count_c + $item->jumlah_total;
                        @endphp
                            <tr>
                                <td>{{$item->nama_uraian}}</td>
                                <td>{{$item->volume}}</td>
                                <td>{{$item->satuan}}</td>
                                <td style="text-align:right">Rp. {{number_format($item->harga_satuan,"0",",",".")}}</td>
                                <td style="text-align:right">Rp. {{number_format($item->jumlah_total,"0",",",".")}}</td>
                                <td>{{$item->keterangan}}</td>
                            </tr>
                        @endif
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align:right">Sub Total 3)</td>
                        <td style="text-align:right">Rp. {{number_format($count_c,"0",",",".")}}</td>
                        <td></td>
                    </tr>
                </div>
                <tr>
                    <td colspan="4" style="text-align:right"><b>Total Biaya :</b></td>
                    <td style="text-align:right"><b>Rp. {{number_format($count_a + $count_b + $count_c,"0",",",".")}}</b></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table>
            <tr>
                <td></td>
                <td width="1000"></td>
                <td style="text-align:center;">Denpasar, {{ date_format($data['rab']->created_at, "d/m/Y") }}</td>
            </tr>
            <tr>
                <td style="text-align:center;">Mengetahui :</td>
                <td>&nbsp;</td>
                <td style="text-align:center;">Disusun Oleh :</td>
            </tr>
            <tr>
                <td style="text-align:center;">Kepala Desa,</td>
                <td>&nbsp;</td>
                <td style="text-align:center;">Tim Penyusun RKP Desa</td>
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
