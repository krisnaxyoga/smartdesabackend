<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Rekapitulasi Surat - {{ $dusun->dusun }}</title>
  
  <style>
    html,
    body {
      font-size: 95%;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      margin: 96px auto 0;
      width: 297mm;
    }

    table {
      width: 100%;
    }

    table th,
    table td {
      font-size: 85%;
      text-align: left;
      padding: 8px;
    }

    .text-center {
      text-align: center;
    }

    .toolbar {
      text-align: center;
      width: 100%;
      padding: 8px;
      background: #232323;
      position: fixed;
      top: 0;
      left: 0;
    }

    .toolbar a {
      padding: 12px 16px;
      color: #ffffff;
      background: darkorchid;
      text-decoration: none;
      display: inline-block;
    }

    @media print {
      body {
        margin-top: 0;
        width: 100%;
      }
      .toolbar {
        display: none;
      }
    }
  </style>
</head>
<body>
  <div class="toolbar">
    <a href="{{ $request->fullUrl() }}&output=pdf">Download PDF</a>
    <a href="{{ $request->fullUrl() }}&output=xls">Download Excel</a>
  </div>
  <div class="text-center">
    <h1 style="margin-top: 8px; margin-bottom: 8px">Rekapitulasi Surat</h1>
    <h2 style="margin-top: 8px; margin-bottom: 8px">{{ $dusun->dusun }}</h2>
    <h3 style="margin-top: 8px; margin-bottom: 32px">{{ date('j M Y', strtotime($request->start_date)) . " - " . date('j M Y', strtotime($request->end_date)) }}</h3>
  </div>
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse">
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
</body>
</html>
