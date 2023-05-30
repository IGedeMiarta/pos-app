<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <link rel="stylesheet" href="style.css" media="all" />
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            /* background: url("{{ asset('css/dimension.png') }}"); */
            /* background: url(dimension.png); */
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }
    </style>
</head>

<body>
    <header class="clearfix">
        {{-- <div id="logo">
            <img src="{{ asset('logo1.png') }}">
        </div> --}}
        <h1>INVOICE {{ $data->reference }}</h1>
        <div id="company" class="clearfix">
            <div>{{ usaha()['nama'] }}</div>
            <div>{{ usaha()['alamat'] }}</div>
            <div>{{ usaha()['hp'] }}</div>
        </div>
        <div id="project">

            <div><span>CLIENT</span> {{ $data->cust->name ?? $data->sup->name }}</div>
            <div><span>ADDRESS</span> {{ $data->cust->address ?? $data->sup->address }}</div>
            <div><span>PHONE</span> {{ $data->cust->phone ?? $data->sup->phone }}</div>
            <div><span>DATE</span> {{ tgl($data->date) ?? tgl($data->date) }}</div>
            @if ($data->due_date ?? false)
                <div><span>DUE DATE</span> {{ tgl($data->due_date) }}</div>
            @endif
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th scope="col">#No</th>
                    <th scope="col">Product</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Price</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $i => $item)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $item->produk->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ rp($item->price) }}</td>
                        <td>{{ rp($item->sub_total) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tbody>

                <tr>
                    <td colspan="4">DISCOUNT <span>({{ $data->discount_percentage . '%' }})</span></td>
                    <td class="total">{{ rp($data->discount_amount) }}</td>
                </tr>
                @if ($data->shipping_amount ?? false)
                    <tr>
                        <td colspan="4">ONGKIR</span></td>
                        <td class="total">{{ rp($data->shipping_amount) }}</td>
                    </tr>
                @endif

                @if ($data->paid_amount ?? false)
                    <tr>
                        <td colspan="4">DP</td>
                        <td class="total">{{ rp($data->paid_amount) }}</td>
                    </tr>
                @endif
                <tr>
                    <td colspan="4">TOTAL</td>
                    <td class="total">{{ rp($data->total_amount ?? $data->sub_total) }}</td>
                </tr>
                <tr>
                    <td colspan="4" class="grand total">Due Amount</td>
                    <td class="grand total">{{ rp($data->due_amount ?? $data->total) }}</td>
                </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTE:</div>
            <div class="notice">{{ $data->note }}</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>
