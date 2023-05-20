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
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card">
            <div class="card-body row">
                <div class="mb-3 col-md-4">
                    <label for="name" class="form-label">Reference<span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('reference')
                            is-invalid
                        @enderror"
                        name="reference" value="{{ old('reference') }}" readonly>
                    @error('reference')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 col-md-4">
                    <label for="name" class="form-label">Suppliers<span class="text-danger">*</span></label>
                    <select name="supplier_id" class="form-select">
                        @foreach ($supplier as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="name" class="form-label">Nama Produk<span class="text-danger">*</span></label>
                    <input type="date"
                        class="form-control @error('date')
                            is-invalid
                        @enderror"
                        name="date" value="{{ old('date') }}">
                    @error('date')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="input-group">
                    <select class="form-select">
                        <option selected disabled>Pilih Produk</option>
                        @foreach ($produk as $item)
                            <option value="{{ $item->id }}">{{ $item->product_name }}</option>
                        @endforeach
                    </select>
                    <input type="number" class="form-control" placeholder="qty">
                    <button type="button" id="btnSelect" class="input-group-text btn-primary">Tambah <i
                            class="bx bx-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td colspan="2">Larry the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
@endsection
