<html>

<head>
    <title>Faktur Pembayaran</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;'>
    <center>
        <table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <tr>
                <td colspan="3" width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
                        <b>{{ usaha()['nama'] }}</b></span>
                    <span style='font-size:12pt'>{{ usaha()['alamat'] }} <br>{{ usaha()['hp'] }} <br><br></span>
                </td>
            </tr>
            <tr>
                <td style="font-size:12pt; font-family:calibri;  padding-right:10px">Invoice </td>
                <td style="font-size:12pt; font-family:calibri; ">:</td>
                <td style="font-size:12pt; font-family:calibri; ">{{ $data->reference }}</td>
            </tr>
            <tr>
                <td style="font-size:12pt; font-family:calibri;  padding-right:10px">Tanggal </td>
                <td style="font-size:12pt; font-family:calibri; ">:</td>
                <td style="font-size:12pt; font-family:calibri; ">{{ $data->date }}</td>
            </tr>
            <tr>
                <td style="font-size:12pt; font-family:calibri;  padding-right:10px">Kasir </td>
                <td style="font-size:12pt; font-family:calibri; ">:</td>
                <td style="font-size:12pt; font-family:calibri; ">{{ 'Kasir01' }}</td>
            </tr>
            <tr>
                <td colspan="3">
                    <hr>
                </td>
            </tr>
        </table>
        <style>
            hr {
                display: block;
                margin-top: 0.5em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
            }
        </style>
        <br>
        <br>
        <table cellspacing='0' cellpadding='0'
            style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>

            <tr align='center'>
                <td width='10%'>Item</td>
                <td width='13%'>Qty</td>
                <td width='13%'>Price</td>
                <td width='13%'>Total</td>
            <tr>
                <td colspan="4">==========================================</td>
            </tr>
            @foreach ($detail as $i => $item)
                <tr>
                    <td style='vertical-align:top'>{{ $item->produk->product_name }}</td>
                    <td style='vertical-align:top; text-align:right; padding-right:10px'>{{ $item->quantity }}</td>
                    <td style='vertical-align:top; text-align:right; padding-right:10px'>{{ rp($item->price) }}</td>
                    <td style='text-align:right; vertical-align:top'>{{ rp($item->sub_total) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <hr>
                </td>
            </tr>

            <tr>
                <td colspan='3'>
                    <div style='text-align:right; color:black'>
                        Discount <span>({{ $data->discount_percentage . '%' }})</span>
                    </div>
                </td>
                <td style='text-align:right; color:black'>{{ rp($data->discount_amount) }}</td>
            </tr>

            <tr>
                <td colspan='3'>
                    <div style='text-align:right; color:black'>
                        Total
                    </div>
                </td>
                <td style='text-align:right; color:black'>{{ rp($data->total_amount ?? $data->sub_total) }}</td>
            </tr>
        </table>
        <br><br>
        <table style='width:350; font-size:12pt;' cellspacing='2'>
            <tr></br>
                <td align='center'>****** TERIMAKASIH ******</br></td>
            </tr>
        </table>
    </center>
    <script>
        window.print();
    </script>
</body>

</html>
