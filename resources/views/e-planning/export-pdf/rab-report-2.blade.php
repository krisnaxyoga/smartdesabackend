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
.flex-container {
        display: flex;
        flex-wrap: wrap;
}
.box{
    width: 50%;
}

</style>
<body onload="print()">
    <div style="padding-bottom: 2%">
        <center>
                <h4>RANCANGAN ANGGARAN BIAYA (RAB)</h4>
        </center>
        <div class="flex-container">
            <div class="box">
                <table>
                    <tr>
                        <td valign="top" width="150px">DESA</td>
                        <td valign="top" width="20px">:</td>
                        <td valign="top" width="200px">{{strtoupper($data['rab']->nama_desa)}}</td>

                    </tr>
                    <tr>
                        <td valign="top">KECAMATAN</td>
                        <td valign="top">:</td>
                        <td valign="top">{{strtoupper($data['rab']->nama_kecamatan)}}</td>
                    </tr>
                    <tr>
                        <td valign="top">KABUPATEN</td>
                        <td valign="top">:</td>
                        <td valign="top">{{strtoupper($data['rab']->nama_kabupaten)}}</td>
                    </tr>
                    <tr>
                        <td valign="top">PROVINSI</td>
                        <td valign="top">:</td>
                        <td valign="top">{{strtoupper($data['rab']->nama_propinsi)}}</td>
                    </tr>
                </table>
            </div>
            <div class="box">
                <table>
                    <tr>
                        <td valign="top">No. RAB</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$data['rab']->no_rab}}</td>
                    </tr>
                    <tr>
                        <td valign="top">BIDANG</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$data['rab']->nama_bidang}}</td>
                    </tr>
                    <tr>
                        <td valign="top">KEGIATAN</td>
                        <td valign="top">:</td>
                        <td valign="top">{{$data['rab']->nama_kegiatan}}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <table id="table" style="width:100%;">
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
                @php
                    $no = 0;
                    $sub_total_no = 0;
                    $grand_total = 0;
                @endphp
                @foreach($data['kategori'] as $category)
                    @php
                        $count = 0;
                    @endphp
                    <tr>
                        <td colspan="6"><b>{{++$no}}. {{$category->name}}</b></td>
                    </tr>
                    @foreach($category->barang as $barang)
                        @foreach($barang->uraian as $item)
                        @php
                            $count = $count + $item->jumlah_total;
                            $grand_total = $grand_total + $item->jumlah_total;
                        @endphp
                            <tr>
                                <td>{{$barang->name}}</td>
                                <td>{{$item->volume}}</td>
                                <td>{{$item->satuan}}</td>
                                <td style="text-align:right">Rp. {{number_format($item->harga_satuan,"0",",",".")}}</td>
                                <td style="text-align:right">Rp. {{number_format($item->jumlah_total,"0",",",".")}}</td>
                                <td>{{$item->keterangan}}</td>
                            </tr>
                        @endforeach
                    @endforeach
                    <tr>
                        <td colspan="4" style="text-align:right">Sub Total {{++$sub_total_no}})</td>
                        <td style="text-align:right">Rp. {{number_format($count,"0",",",".")}}</td>
                        <td></td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right"><b>Total Biaya :</b></td>
                    <td style="text-align:right"><b>Rp. {{number_format($grand_total,"0",",",".")}}</b></td>
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
