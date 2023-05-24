<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('logo1.png') }}" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('thame') }}/assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('thame') }}/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('thame') }}/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('thame') }}/assets/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('thame') }}/assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('thame') }}/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('thame') }}/assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('thame') }}/assets/css/app.css" rel="stylesheet">
    <link href="{{ asset('thame') }}/assets/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('thame') }}/assets/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('thame') }}/assets/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('thame') }}/assets/css/header-colors.css" />
    <title>Invoice PDF</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div id="invoice">

                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                <header>
                                    <div class="row">
                                        <div class="col">
                                            <a href="javascript:;">
                                                <img src="{{ asset('logo1.png') }}" width="80" alt="" />
                                            </a>
                                        </div>
                                        <div class="col company-details">
                                            <h2 class="name">
                                                <a target="_blank" href="javascript:;">
                                                    HOLOGRAM
                                                </a>
                                            </h2>
                                            <div>ALAMAT HOLOGRAM</div>
                                            <div>+62 815 0000 0000</div>
                                            <div>hologram@example.com</div>
                                        </div>
                                    </div>
                                </header>
                                <main>
                                    <div class="row contacts">
                                        <div class="col invoice-to">
                                            <div class="text-gray-light">INVOICE UNTUK:</div>
                                            <h2 class="to">{{ $data->cust->name }}</h2>
                                            <div class="address">{{ $data->cust->address }}</div>
                                            <div class="phone">{{ $data->cust->phone }}</div>
                                        </div>
                                        <div class="col invoice-details">
                                            <h1 class="invoice-id">{{ $data->reference }}</h1>
                                            <div class="to_date">{{ 'Reference Date: ' . tgl($data->date) }}</div>
                                            <div class="to_due_date">{{ 'Due Date : ' . tgl($data->due_date) }}</div>
                                        </div>
                                    </div>
                                    <table class="table table-striped data-table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($detail as $i => $item)
                                                <td>{{ $i + 1 }}</td>
                                                <td>{{ $item->produk->product_name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ rp($item->price) }}</td>
                                                <td>{{ rp($item->sub_total) }}</td>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr class="table-active">
                                                <th colspan="3">Discount</th>
                                                <th class="dc text-end">{{ $data->discount_percentage . '%' }}</th>
                                                <th class="dc_am text-end">{{ rp($data->discount_amount) }}</th>
                                            </tr>
                                            <tr class="table-active">
                                                <th colspan="4" class="text-end">Total</th>
                                                <th class="totalVal text-end">{{ rp($data->total_amount) }}</th>
                                            </tr>
                                            <tr class="table-active">
                                                <th colspan="4" class="text-end">DP</th>
                                                <th class="totalVal text-end">{{ rp($data->paid_amount) }}</th>
                                            </tr>
                                            <tr class="table-active">
                                                <th colspan="4" class="text-end">Sisa</th>
                                                <th class="totalVal text-end">{{ rp($data->due_amount) }}</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <br>
                                    <div class="notices">
                                        <div>NOTICE:</div>
                                        <div class="notice">Order Akan otomatis dibuat saat customer melakukan dp
                                            minimal 30% dari total order.</div>
                                    </div>
                                </main>
                                <footer>Invoice was created on a computer and is valid without the signature and
                                    seal.
                                </footer>
                            </div>
                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--end wrapper-->
    <!--start switcher-->

    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('thame') }}/assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('thame') }}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('thame') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('thame') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('thame') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--app JS-->
    <script src="{{ asset('thame') }}/assets/js/app.js"></script>
</body>

</html>
