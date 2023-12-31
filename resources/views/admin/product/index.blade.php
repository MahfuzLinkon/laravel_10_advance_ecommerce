@extends('admin.master')
@section('title', 'Manage Product')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item">Product</li>
                                <li class="breadcrumb-item active">Manage</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start page title -->
            <div class="row">
                <div class="col-xl-12 m-auto ">
                    <div class="card ">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Manage Product</h4>

                            <table class="table p-5">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Model</th>
                                        <th>Regular Price</th>
                                        <th>Selling Price</th>
                                        <th style="">Image</th>
                                        <th>Status</th>
                                        <th style="width: 13%">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($products as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->model }}</td>
                                    <td>{{ $item->regular_price }}</td>
                                    <td>{{ $item->selling_price }}</td>
                                    <td>
                                        <img src="{{ asset($item->image) }}" width="100" height="60" alt="">
{{--                                        @foreach(explode('|', $item->other_images) as $image)--}}
{{--                                            <img src="{{ asset($image) }}" width="100" height="60" alt="">--}}
{{--                                        @endforeach--}}
                                    </td>
                                    <td><span class="badge bg-{{ $item->status === 1 ? 'success' : 'secondary' }}">{{ $item->status === 1 ? 'Published' : 'Unpublished' }}</span></td>
                                    <td >
                                        <a href="{{ route('admin.products.show', $item->slug) }}" title="Details" class="btn btn-primary">
                                            <span><i class="fas far fa-eye"></i></span>
                                        </a>
                                        <a href="{{ route('admin.products.status', $item->slug) }}" title="{{ $item->status === 1 ? 'Make Unpublished' : 'Make Published' }}" class="btn btn-{{ $item->status === 1 ? 'secondary' : 'success' }}">
                                            <span><i class="fas far fa-thumbs-{{ $item->status === 1 ? 'down' : 'up' }}"></i></span>
                                        </a>
                                        <a href="{{ route('admin.products.edit', $item->slug) }}" title="Edit" class="btn btn-primary"><span><i class="fas fa-edit"></i></span></a>
                                        <form id="Unit-delete" onsubmit="return confirm('Are You Sure Want to Delete?')" action="{{ route('admin.products.destroy', $item->slug) }}" method="post" style="display: inline-block">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" title="Delete" class="btn btn-danger"><span><i class="fas fa-trash"></i></span></button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </div>
@endsection
