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
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <button class="btn btn-primary mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
                        {{ $title }} <i class="bx bx-plus"></i></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0" id="example">
                    <thead class="table-light table-bordered ">
                        <tr>
                            <th>Category Code</th>
                            <th>Category Name</th>
                            <th>Product Count</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($table as $item)
                            <tr>
                                <td>{{ $item->category_code }}</td>
                                <td>{{ $item->category_name }}</td>
                                <td>10</td>
                                <td>

                                    <form action="{{ url('kategori/' . $item->id) }}" method="POST">
                                        @csrf
                                        @method('Delete')
                                        <a class="btn btn-info btn-sm btnEdit" data-code="{{ $item->category_code }}"
                                            data-name="{{ $item->category_name }}" data-id="{{ $item->id }}"
                                            data-bs-toggle="modal" data-bs-target="#modalEdit"><i
                                                class="lni lni-pencil"></i></a>
                                        <button type="submit" class="btn btn-danger btn-sm btnDelete"><i
                                                class="lni lni-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal add -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add {{ $title ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label">Category Code<span class="text-danger">*</span></label>
                            <input type="text" name="category_code" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="category_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update {{ $title ?? '' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="post" id="formEdit" action="">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="code" class="form-label">Category Code<span class="text-danger">*</span></label>
                            <input type="text" name="category_code" class="form-control" id="code">
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" name="category_name">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('.btnEdit').on('click', function() {
                const id = $(this).data('id');
                const code = $(this).data('code');
                const name = $(this).data('name');
                const url = "{{ url('kategori') }}" + '/' + id;
                $('#formEdit').attr('action', url);
                $('#id').val(id);
                $('#code').val(code);
                $('#name').val(name);

            })
        })
    </script>
@endpush
