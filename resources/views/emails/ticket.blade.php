<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>E-Ticket</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body style="margin: 0; padding: 0; background: #efeef6; font-family: sans-serif">
    <table cellpadding="0" cellspacing="0" width="100%">
        <tr>
            <td style="padding: 32px">
                <table align="center" cellpadding="0" cellspacing="0" width="640" style="border-collapse: collapse; background: #ffffff">
                    <tr>
                        <td style="padding: 32px 32px">
                            @if ($booking->merchant->logo !== null)
                                <img src="{{ $booking->merchant->logo }}" width="200" /><br><br>
                            @else
                                <h1 style="margin-top: 0px">{{ $booking->merchant->name }}</h1>
                            @endif
                            <p>Dear <strong>{{ $booking->contact_name }}</strong>,</p>
                            <p>
                                We have received your payment for the transaction below:<br><br>
                                Transaction Code: <strong>{{ $booking->booking_code }}</strong><br>
                                Transaction Date: <strong>{{ date('F j, Y', strtotime($booking->booking_date)) }}</strong>
                            </p>
                            <p>Thank you for your purchase at {{ $booking->merchant->name }}. You can check your e-ticket below:</p>
                            @foreach ($details as $index => $detail)
                                <table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse; margin-bottom: 24px; margin-top: 24px">
                                    <tr>
                                        <td style="padding: 8px; background: #212121; color: #fff">
                                        {{ $detail->schedule->origin->name }} - {{ $detail->schedule->destination->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 8px">
                                            <span>Depature: {{ date('F j, Y', strtotime($detail->item_date)) }}</span><br><br>
                                            <span>
                                                FROM: <strong>{{ $detail->schedule->origin->name }}
                                                ({{ date('H:i', strtotime($detail->schedule->departure)) }})</strong><br>
                                                TO: <strong>{{ $detail->schedule->destination->name }}
                                                ({{ date('H:i', strtotime($detail->schedule->arrival)) }})</strong>
                                            </span>
                                            <br>
                                            <br>
                                            <a href="{{ url('download/ticket/' . $booking->vouchers[$index]->voucher_code . '?email=' . $booking->contact_email) }}" style="display: block; padding: 16px; text-transform: uppercase; color: #fff; background: #689f38; text-decoration: none; text-align: center">Download E-Ticket</a>
                                        </td>
                                    </tr>
                                </table>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>