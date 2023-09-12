@extends('admin.master')
@section('title', 'Manage Brand')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Brand</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item">Brand</li>
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
                    <div class="card " >
                        <div class="card-body">
                            <h4 class="card-title mb-5">Manage Brand</h4>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Brand Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach($brands as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->description }}</td>
                                    <td><img src="{{ asset($item->image) }}" alt="" height="60" width="110"></td>
                                    <td><span class="badge bg-{{ $item->status === 1 ? 'success' : 'secondary' }}">{{ $item->status === 1 ? 'Published' : 'Unpublished' }}</span></td>
                                    <td >
                                        <a href="{{ route('admin.brands.status', $item->slug) }}" title="{{ $item->status === 1 ? 'Make Unpublished' : 'Make Published' }}" class="btn btn-{{ $item->status === 1 ? 'secondary' : 'success' }}">
                                            <span><i class="fas far fa-thumbs-{{ $item->status === 1 ? 'down' : 'up' }}"></i></span>
                                        </a>
                                        <a href="{{ route('admin.brands.edit', $item->slug) }}" title="Edit" class="btn btn-primary"><span><i class="fas fa-edit"></i></span></a>
                                        <form onsubmit="return confirm('Are You Sure Want to Delete?')" action="{{ route('admin.brands.destroy', $item->slug) }}" method="post" style="display: inline-block">
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
