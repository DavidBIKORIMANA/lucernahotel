<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Invoice</title>

        <style>
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
                font-size: 12px;
                line-height: 24px;
                font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
            }

            .invoice-box table td {
                padding: 5px;
                vertical-align: top;
            }

            .invoice-box table tr td:nth-child(2) {
                text-align: right;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.top table td.title {
                font-size: 45px;
                line-height: 45px;
                color: #333;
            }

            .invoice-box table tr.information table td {
                padding-bottom: 40px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 20px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }

            /** RTL **/
            .invoice-box.rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }

            .invoice-box.rtl table {
                text-align: right;
            }

            .invoice-box.rtl table tr td:nth-child(2) {
                text-align: left;
            }
            .total{
                font-weight: bold;
                font-size: 14px;
            }
        </style>
    </head>

    <body>
        @php
            $setting = App\Models\SiteSetting::find(1);
        @endphp
        <div class="invoice-box">
            <table cellpadding="0" cellspacing="0">
                <tr class="top">
                    <td colspan="5">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="{{ public_path('logo.png') }}" style="width: 50%; max-width: 300px" />
                                </td>

                                <td>
                                    Invoice #: {{ $editData->code }}<br />
                                    Created at: {{ \Carbon\Carbon::parse($editData->created_at)->format('d/m/Y') }}<br />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="5">
                        <table>
                            <tr>
                                <td>
                                    {{ config('app.name', '') }}<br />
                                    {{ $setting->address }}<br />
                                    {{ $setting->phone }}<br />
                                    {{ $setting->email }}
                                </td>

                                <td>
                                    {{ $editData->name }}<br />
                                    {{ $editData->phone }}<br />
                                    {{ $editData->email }}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <!-- <tr class="heading">
                    <td>Payment Method</td>

                    <td>Check #</td>
                </tr>

                <tr class="details">
                    <td>Check</td>

                    <td>1000</td>
                </tr> -->

                <tr class="heading">
                    <td>Room Type</td>
                    <td>Total Room</td>
                    <td>Price</td>
                    <td>Check In / Out Date</td>
                    <td>Total Days</td>
                    <td>Total</td>
                </tr>

                <tr class="item">
                    <td>{{ $editData->room->type->name }}</td>
                    <td>{{ $editData->number_of_rooms }}</td>
                    <td>{{ number_format($editData->actual_price) }} $</td>
                    <td>{{ \Carbon\Carbon::parse($editData->check_in)->format('d/m/Y') }} / {{ \Carbon\Carbon::parse($editData->check_out)->format('d/m/Y') }}</td>
                    <td>{{ $editData->total_night }}</td>
                    <td>{{ number_format($editData->actual_price * $editData->number_of_rooms) }} $</td>
                </tr>


                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal</td>
                    <td>{{ number_format($editData->subtotal) }} $</td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Discount</td>
                    <td>{{ number_format($editData->discount) }} $</td>
                </tr>
                <tr class="total">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Grand Total</td>
                    <td>{{ number_format($editData->total_price) }} $</td>
                </tr>
            </table>
            <br>
            <br>
            <div class="invoice-footer">
              Thank you for choosing our services.
              <br/> We hope to see you again soon
              <br/>
              <strong>~{{ config('app.name', '') }}~</strong>
            </div>
            <br>
            <div class="authority float-right mt-5">
              <p>-----------------------------------</p>
              <h5>Authority Signature:</h5>
            </div>
        </div>
        
    </body>
</html>