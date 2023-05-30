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
    <form action="{{ isset($i->product_image) ? '' : url('produk') }}" method="POST" enctype="multipart/form-data">
        @if (isset($i->product_image))
            @method('PUT')
        @endif
        @csrf
        <button type="submit" class="btn btn-primary mb-3"><i class="bx bx-plus"></i> Simpan Produk</button>
        <div class="card">
            <div class="card-body row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Nama Produk<span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('product_name')
                            is-invalid
                        @enderror"
                        name="product_name" value="{{ $i->product_name ?? old('product_name') }}">
                    @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Kode Produk<span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('product_code')
                            is-invalid
                        @enderror"
                        name="product_code" value="{{ $i->product_note ?? old('product_note') }}">
                    @error('product_code')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Category<span class="text-danger">*</span></label>
                    <select name="category_id"
                        class="form-select @error('category_id')
                            is-invalid
                        @enderror">
                        <option selected disabled>Select Category</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" @if ($i->category_id ?? old('category_id') == $item->id) selected @endif>
                                {{ $item->category_name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Barcode Symbology</label>
                    <select name="product_barcode_symbology"
                        class="form-select @error('product_barcode_symbology')
                            is-invalid
                        @enderror">
                        <option selected disabled>Select Symbology</option>
                        <option value="Code 128" @if ($i->product_barcode_symbology ?? old('product_barcode_symbology') == 'Code 128') selected @endif>Code 128 </option>
                        <option value="Code 39"@if ($i->product_barcode_symbology ?? old('product_barcode_symbology') == 'Code 39') selected @endif>Code 39</option>
                        <option value="UPC-A"@if ($i->product_barcode_symbology ?? old('product_barcode_symbology') == 'UPC-A') selected @endif>UPC-A</option>
                    </select>
                    @error('product_barcode_symbology')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Harga Beli<span class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control @error('product_cost')
                            is-invalid
                        @enderror"
                        name="product_cost" value="{{ $i->product_cost ?? old('product_cost') }}">
                    @error('product_cost')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Harga Jual<span class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control @error('product_price')
                            is-invalid
                        @enderror"
                        name="product_price" value="{{ $i->product_price ?? old('product_price') }}">
                    @error('product_price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Jumlah<span class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control @error('product_quantity')
                            is-invalid
                        @enderror"
                        name="product_quantity" value="{{ $i->product_quantity ?? old('product_quantity') }}">
                    @error('product_quantity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Jumlah Notifikasi<span class="text-danger">*</span></label>
                    <input type="number"
                        class="form-control @error('product_stock_alert')
                            is-invalid
                        @enderror"
                        name="product_stock_alert" value="{{ $i->product_stock_alert ?? old('product_stock_alert') }}">
                    @error('product_stock_alert')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Unit<span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('product_unit')
                            is-invalid
                        @enderror"
                        name="product_unit" value="{{ $i->product_unit ?? old('product_unit') }}">
                    @error('product_unit')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Catatan Produk<span class="text-danger">*</span></label>
                    <textarea type="text"
                        class="form-control @error('product_note')
                            is-invalid
                        @enderror"
                        name="product_note">{{ $i->product_note ?? old('product_note') }}</textarea>
                    @error('product_note')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Gambar Produk<span class="text-danger">*</span></label>
                    @error('image')
                        <span class="text-danger"><br>{{ $message }}</span>
                    @enderror
                    <input type="file"
                        class="dropify @error('image')
                        is-invalid
                    @enderror"
                        name="image"
                        data-default-file="{{ isset($i->product_image) ? url($i->product_image) : '' }}" />
                </div>

            </div>
        </div>
    </form>
@endsection
