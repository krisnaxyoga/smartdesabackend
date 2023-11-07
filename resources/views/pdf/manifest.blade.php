<!DOCTYPE html>
<html>
<head>
    <title>Manifest {{ $schedule->origin->name }} - {{ $schedule->destination->name }} {{ date('j F Y', strtotime(request()->booking_date)) }} {{ date('H:i', strtotime($schedule->departure)) }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }
        .paper-a4 {
            width: 100%;
        }
        table { 
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }
        table.bordered { 
            border: 1px solid #000;
        }
        table.bordered td { 
            padding: 8px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        table.bordered th { 
            padding: 8px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        table.bordered tr:last-child td {
            border-bottom: 0px solid #000;
        }
        .header {
            width: 100%;
            margin-bottom: 10px
        }
        .header h1 {
            margin: 0
        }
        .text-right {
            text-align: right
        }
        .valign-top {
            vertical-align: top
        }
        .valign-bottom {
            vertical-align: bottom
        }
        .no-padding {
            padding: 0;
        }
        .no-margin {
            margin: 0 !important;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
        .mt-20 {
            margin-top: 20px;
        }
        .mb-10 {
            margin-bottom: 10px;
        }
        .mt-10 {
            margin-top: 10px;
        }
        .mb-5 {
            margin-bottom: 5px;
        }
        .mt-5 {
            margin-top: 5px;
        }
        .mb-0 {
            margin-bottom: 0px;
        }
        .mt-0 {
            margin-top: 0px;
        }
        hr {
            border: 0;
            height: 1px;
            background: #333;
            margin: 24px 0
        }
        .notes {
            padding: 16px;
            margin-bottom: 32px;
            border: 1px solid
        }
        h1, h2, h3, h4, h5, h6 {
            color: #000
        }
        .heading {
            background: #dedede;
            padding: 8px 16px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="paper-a4">
        <table class="header">
            <tr>
                <td class="valign-top">
                    @if ($schedule->merchant->logo !== null)
                        <img src="{{ $schedule->merchant->logo }}" height="36" style="margin-bottom: 10px" /><br>
                    @endif
                    <h3 class="no-margin">{{ $schedule->merchant->name }}</h3>
                    {{ $schedule->merchant->address }}<br>
                    Email: {{ $schedule->merchant->email }}<br>
                    CS: {{ $schedule->merchant->phone }}<br>
                </td>
                <td class="valign-top" style="text-align: right">
                    <h1 style="margin: 8px 0">Manifest</h1>
                    <h3 style="margin: 8px 0">{{ strtoupper($schedule->origin->name) }} - {{ strtoupper($schedule->destination->name) }}</h3>
                    <h3 style="margin: 8px 0 2em">{{ date('j F Y', strtotime(request()->booking_date)) }}, {{ date('H:i', strtotime($schedule->departure)) }}</h3>
                </td>
            </tr>
        </table>
        <center>
        </center>
        <table class="bordered">
            <thead>
                <tr>
                    <th width="30">No.</th>
                    <th>Name</th>
                    <th>Nationality</th>
                    <th>Type</th>
                    <th width="10">Check</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($passengers as $key => $value)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $value->salutation }} {{ $value->name }}</td>
                    <td>{{ $value->country->name }}</td>
                    <td>{{ $value->type }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>