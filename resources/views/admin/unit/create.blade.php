@extends('admin.master')
@section('title', 'Create new unit')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Unit</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Unit</li>
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
                                <h4 class="card-title mb-5">Crate New Unit</h4>

                                <form method="post" enctype="multipart/form-data" action="{{ route('admin.units.store') }}">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="name" class="col-sm-3 col-form-label">Unit Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" id="name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="name" class="col-sm-3 col-form-label">Unit Code <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="code" class="form-control" id="code">
                                            @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="description" class="col-sm-3 col-form-label">Unit Description <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
{{--                                            <input type="text" name="description" class="form-control" id="description">--}}
                                            <textarea name="description" id="description" cols="30" class="form-control" rows="5"></textarea>
                                            @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row justify-content-end">
                                        <div class="col-sm-9">
                                            <div>
                                                <button type="submit" class="btn btn-primary w-md">Create</button>
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
