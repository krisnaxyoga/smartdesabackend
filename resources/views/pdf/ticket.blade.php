<!DOCTYPE html>
<html>
<head>
    <title>{{ $filename }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body {
            font-family: sans-serif;
            font-size: 13px;
        }
        .paper-a4 {
            width: 100%;
        }
        table { 
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
            margin-bottom: 16px
        }
        table.bordered { 
            border: 1px solid #000;
        }
        table.bordered td { 
            padding: 4px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        table.bordered th { 
            padding: 4px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        table.bordered tr:last-child td {
            border-bottom: 0px solid #000;
        }
        .header {
            width: 100%;
            margin-bottom: 32px
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
                    @if ($data->merchant->logo !== null)
                        <img src="{{ $data->merchant->logo }}" height="48" style="margin-bottom: 10px" /><br>
                    @else
                        <h1 class="mb-10">{{ $data->merchant->name }}</h1>
                    @endif
                </td>
                <td class="valign-top text-right">
                    Email: {{ $data->merchant->email }}<br>
                    CS: {{ $data->merchant->phone }}<br>
                </td>
            </tr>
        </table>
        <h3 class="heading">E-Ticket Information</h3>
        <table>
            <tr>
                <td class="valign-top" width="70%">
                    <table>
                        <tr>
                            <td class="valign-bottom" width="100">Booking Date</td>
                            <td class="valign-bottom" width="10">:</td>
                            <td class="valign-bottom">{{ date('F j, Y', strtotime($data->booking->booking_date)) }}</td>
                        </tr>
                        <tr>
                            <td>Booking Reference</td>
                        </tr>
                        <tr>
                            <td><h1 class="mt-10 mb-5">{{ $ticketCode }}</h1></td>
                        </tr>
                    </table>
                </td>
                <td class="text-right valign-top">
                    <img width="100" src="{{ $qrcode->render($ticketCode) }}">
                </td>
            </tr>
        </table>
        <h3 class="heading">Ticket Details</h3>
        <table class="bordered">
            <tr>
                <td style="padding: 16px" class="valign-top">
                    <p class="no-margin">Depart</p>
                    <strong>{{ strtoupper($data->detail->schedule->origin->name ?: '-') }} ({{ $data->detail->schedule->origin->port_code }})</strong><br>
                    <p class="mt-20 mb-0">{{ date('F j, Y', strtotime($data->detail->item_date)) }}</p>
                    <h2 style="color: #000" class="mt-0 mb-0">{{ date('H:i', strtotime($data->detail->schedule->departure)) }}</h2>
                </td>
                <td style="padding: 16px" class="valign-top">
                    <p class="no-margin">Arrive</p>
                    <strong>{{ strtoupper($data->detail->schedule->destination->name ?: '-') }} ({{ $data->detail->schedule->destination->port_code }})</strong><br>
                    <p class="mt-20 mb-0">{{ date('F j, Y', strtotime($data->detail->item_date)) }}</p>
                    <h2 style="color: #000" class="mt-0 mb-0">{{ date('H:i', strtotime($data->detail->schedule->arrival)) }}</h2>
                </td>
            </tr>
        </table>
        <h3 class="heading">Passenger Details</h3>
        <table class="bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Full Name</th>
                    <th class="text-center">Nationality</th>
                    <th class="text-center">Type</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 0; @endphp
                @foreach ($data->booking->passengers as $passenger)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $passenger->salutation }} {{ $passenger->name }}</td>
                    <td>{{ $passenger->country->name }}</td>
                    <td>{{ $passenger->type }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if ($data->pickup_area !== null || $data->dropoff_area !== null)
        <h3 class="heading">Pickup / Drop Off Services</h3>
        <table class="bordered">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Area</th>
                    <th>Note / Remark</th>
                </tr>
            </thead>
            <tbody>
                @if ($data->pickup_area !== null)
                <tr>
                    <td>PICKUP</td>
                    <td>{{ $data->pickup->area->name }}</td>
                    <td>{{ $data->pickup_remark ?: '-' }}</td>
                </tr>
                @endif
                @if ($data->dropoff_area !== null)
                <tr>
                    <td>DROPOFF</td>
                    <td>{{ $data->dropoff->area->name }}</td>
                    <td>{{ $data->dropoff_remark ?: '-' }}</td>
                </tr>
                @endif
            </tbody>
        </table>
        @endif
        @if ($data->detail->schedule->policy !== null || $data->detail->schedule->policy !== '')
            <h3 class="heading">Policy</h3>
            {!! $data->detail->schedule->policy !!}
        @endif
    </div>
</body>
</html>