@extends('partials.app')
@push('widget')
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">{{ $title ?? '' }}</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-shopping-bag"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--end breadcrumb-->
@endpush
@section('content')
    <form action="{{ url('order') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body row">
                <div class="mb-3 col-md-3">
                    <label for="name" class="form-label">Reference<span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control ref @error('reference')
                            is-invalid
                        @enderror"
                        name="reference" value="{{ ref('OD') }}" readonly>
                    @error('reference')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-3">
                    <label for="name" class="form-label">Customer<span class="text-danger">*</span></label>
                    <select name="customer_id" class="form-select custId">
                        <option selected disabled>Pilih Customer</option>
                        @foreach ($cust as $item)
                            <option value="{{ $item->id }}" data-name="{{ $item->name }}"
                                data-phone="{{ $item->phone }}" data-address="{{ $item->address }}">{{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="custName">
                <input type="hidden" id="custPhone">
                <input type="hidden" id="custAddress">

                <div class="mb-3 col-md-3">
                    <label for="name" class="form-label">Order Date<span class="text-danger">*</span></label>
                    <input type="date"
                        class="form-control order_date @error('date')
                            is-invalid
                        @enderror"
                        name="date" value="{{ old('date') }}">
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-3">
                    <label for="name" class="form-label">Due Date<span class="text-danger">*</span></label>
                    <input type="date"
                        class="form-control due_date @error('due_date')
                            is-invalid
                        @enderror"
                        name="due_date" value="{{ old('due_date') }}">
                    @error('due_date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="input-group">
                    <select class="form-select ProductId">
                        <option selected disabled>Pilih Produk</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                        @endforeach
                    </select>
                    <input type="number" class="form-control Qty" placeholder="qty">
                    <button type="button" id="btnSelect" class="input-group-text btn-primary">Tambah <i
                            class="bx bx-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped data-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Price</th>
                            <th scope="col" class="text-end">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr class="table-active">
                            <th colspan="2">Total</th>
                            <th class="qty"></th>
                            <th class="price"></th>
                            <th class="total text-end"></th>
                        </tr>
                        <input type="hidden" class="totalVal">
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="card ">
            <div class="card-body row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Discount <span>(%)</span></label>
                        <input type="number"
                            class="form-control dc @error('discount_percentage')
                            is-invalid
                        @enderror"
                            name="discount_percentage" value="{{ old('discount_percentage') }}">
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Discount Amount</label>
                        <input type="number"
                            class="form-control dc_amount @error('discount_amount')
                            is-invalid
                        @enderror"
                            name="discount_amount" value="{{ old('discount_amount') }}" readonly>
                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">Note</label>
                        <textarea name="note" class="form-control" rows="5"></textarea>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="name" class="form-label">DP</label>
                        <input type="number" name="dp" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Metode Pembayaran</label>
                        <select name="method" class="form-select">
                            <option value="1">Cash</option>
                            <option value="2">Transfer</option>
                        </select>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <h4>Total Order:</h4>
                        <h1 class="display-5 text-end" id="TotalOrder"></h1>
                        <input type="number" name="total" class="TotalOrder" hidden>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="submit">Process Order</button>
                    </div>
                </div>

            </div>
        </div>

    </form>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('#btnProcess').on('click', function() {

                $('.to').html($('#custName').val());
                $('.phone').html($('#custPhone').val());
                $('.address').html($('#custAddress').val());
                $('.to_date').html('Tanggal Invoice: ' + dateFormat($('.order_date').val()));
                $('.to_due_date').html('Tanggal Jadi: ' + dateFormat($('.due_date').val()));

            });
            $('.custId').on('change', function() {
                const name = $(this).find(':selected').data('name')
                $('#custName').val(name);
                const phone = $(this).find(':selected').data('phone')
                $('#custPhone').val(phone);
                const address = $(this).find(':selected').data('address')
                $('#custAddress').val(address);
            })

            function formatNumber(number) {
                return number.toLocaleString();
            }

            function dateFormat(date) {
                var parts = date.split('-');
                var year = parseInt(parts[0]);
                var month = parseInt(parts[1]);
                var day = parseInt(parts[2]);

                var months = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli',
                    'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];

                var formattedDate = day + ' ' + months[month - 1] + ', ' + year;

                return formattedDate;
            }

            function clearInp() {
                $('.ProductId').val('');
                $('.Qty').val('');
            }

            $('#btnSelect').on('click', function(e) {
                e.preventDefault();
                $('#btnSelect').attr('disabled', true);
                const product_id = $('.ProductId').val();
                const qty = $('.Qty').val();
                const ref = $('.ref').val();

                $.ajax({
                    url: "{{ route('temp') }}", // Get form action URL
                    method: "POST", // Get form method (POST)
                    data: {
                        product_id: product_id,
                        qty: qty,
                        ref: ref,
                        type: 'buy'
                    }, // Set form data
                    success: function(response) {
                        console.log(response);
                        // Handle success response
                        reloadTable();
                        clearInp();
                        $('#btnSelect').attr('disabled', false);
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.log(error);
                    }
                });
            });

            reloadTable();

            function reloadTable() {
                const ref = $('.ref').val();
                var tbody = $('.data-table tbody');
                tbody.empty();
                $.ajax({
                    url: "{{ url('temp-table') }}" + "/" + ref,
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {

                        // Iterate over the data and populate the table rows
                        $.each(response.data, function(index, item) {
                            var row = $('<tr>');
                            row.append($('<td>').text(item.no));
                            row.append($('<td>').text(item.product));
                            row.append($('<td>').text(item.qty));
                            row.append($('<td>').text(formatNumber(item.price)));
                            row.append($('<td class="text-end">').text(formatNumber(item
                                .total)));
                            tbody.append(row);
                        });
                        $('.price').html(formatNumber(response.price));
                        $('.total').html(formatNumber(response.total));
                        $('.totalVal').val(response.total);
                        $('.qty').html(response.qty);
                        totalOrder();
                    },
                    error: function(xhr, status, error) {
                        console.log(error); // Handle error if needed
                    }
                });
            }
            $('.dc').on('keyup', delay(function() {
                var val = parseInt($(this).val());
                var total = parseInt($('.totalVal').val());
                var dc = (val * total) / 100;
                $('.dc_amount').val(dc);
                totalOrder();
            }, 500));

            $('.tax').on('keyup', delay(function() {
                var val = parseInt($(this).val());
                var total = parseInt($('.totalVal').val());
                var dc = (val * total) / 100;
                $('.tax_am').val(dc);
                totalOrder();

            }, 500));

            totalOrder();

            function totalOrder() {
                var total = $('.totalVal').val();
                var dc = $('.dc_amount').val() == '' ? 0 : $('.dc_amount').val();
                var dc_p = $('.dc').val() == '' ? 0 : $('.dc').val();
                var totalD = parseInt(total) - parseInt(dc);
                $('#TotalOrder').html('Rp ' + formatNumber(totalD));
                $('.TotalOrder').val(totalD);
                $('.totalVal').html(formatNumber(totalD));
                $('.dc').html(formatNumber(dc_p) + '%')
                $('.dc_am').html(formatNumber(dc))
            }

            function delay(callback, ms) {
                var timer = 0;
                return function() {
                    var context = this,
                        args = arguments;
                    clearTimeout(timer);
                    timer = setTimeout(function() {
                        callback.apply(context, args);
                    }, ms || 0);
                };
            }


        });
    </script>
@endpush
