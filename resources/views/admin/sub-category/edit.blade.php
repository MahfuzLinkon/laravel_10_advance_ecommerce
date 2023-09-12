@extends('admin.master')
@section('title', 'Edit category')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">SubCategory</li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <!-- start page title -->
            <div class="row">
                <div class="col-xl-10 m-auto ">
                    <div class="card " style="padding: 30px 120px;">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Edit SubCategory</h4>

                            <form method="post" enctype="multipart/form-data" action="{{ route('admin.sub-categories.update', $subCategory->slug) }}">
                                @csrf
                                @method('put')
                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">Category Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <select name="category_id" id="" class="form-control">
                                            <option selected disabled>--Select Category--</option>
                                            @foreach($categories as $item)
                                                <option {{  $item->id == $subCategory->category_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="name" class="col-sm-3 col-form-label">SubCategory Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" value="{{ $subCategory->name }}" name="name" class="form-control" id="name">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="description" class="col-sm-3 col-form-label">SubCategory Description <span class="text-danger">*</span></label>
                                    <div class="col-sm-9">
                                        {{--                                            <input type="text" name="description" class="form-control" id="description">--}}
                                        <textarea name="description" id="description" cols="30" class="form-control" rows="5">{{ $subCategory->description }}</textarea>
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <label for="image" class="col-sm-3 col-form-label">SubCategory Image</label>
                                    <div class="col-sm-9">
                                        <input type="file" name="image" class="form-control" id="image">
                                    </div>
                                </div>


                                <div class="row justify-content-end">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-md">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </div>
@endsection
