@extends('admin.master')
@section('title', 'Create new product')
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
                                <li class="breadcrumb-item active">Product</li>
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
                                <h4 class="card-title mb-5">Crate New Product</h4>

                                <form method="post" enctype="multipart/form-data" action="{{ route('admin.products.store') }}">
                                    @csrf
                                    <div class="row mb-4">
                                        <label for="category_id" class="col-sm-3 col-form-label">Category Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="category_id" id="category_id" class="form-control">
                                                <option selected disabled>--Select Category--</option>
                                                @foreach($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="sub_category_id" class="col-sm-3 col-form-label">SubCategory Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="sub_category_id" id="sub_category_id" class="form-control">
                                                <option selected disabled>--Select SubCategory--</option>
                                                @foreach($sub_categories as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('sub_category_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="brand_id" class="col-sm-3 col-form-label">Brand Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="brand_id" id="brand_id" class="form-control">
                                                <option selected disabled>--Select Brand--</option>
                                                @foreach($brands as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="unit_id" class="col-sm-3 col-form-label">Unit Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <select name="unit_id" id="unit_id" class="form-control">
                                                <option selected disabled>--Select Unit--</option>
                                                @foreach($units as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('unit_id')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="name" class="col-sm-3 col-form-label">Product Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="name" class="form-control" id="name">
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="name" class="col-sm-3 col-form-label">Product Code <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="code" class="form-control" id="code">
                                            @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="model" class="col-sm-3 col-form-label">Product Model</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="model" class="form-control" id="model">
                                            @error('model')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="stock_amount" class="col-sm-3 col-form-label">Stock Amount<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="number" name="stock_amount" class="form-control" id="stock_amount">
                                            @error('stock_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="regular_price" class="col-sm-3 col-form-label">Regular Price<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="regular_price" class="form-control" id="regular_price">
                                            @error('regular_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="selling_price" class="col-sm-3 col-form-label">Selling Price<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="text" name="selling_price" class="form-control" id="selling_price">
                                            @error('selling_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="image" class="col-sm-3 col-form-label">Feature Image<span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <input type="file" name="image" class="form-control" id="image">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="other_images" class="col-sm-3 col-form-label">Other Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="other_images[]" multiple class="form-control" id="other_images">
                                            @error('other_images')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="row mb-4">
                                        <label for="short_description" class="col-sm-3 col-form-label">Short Description <span class="text-danger">*</span></label>
                                        <div class="col-sm-9">
                                            <textarea name="short_description" id="short_description" cols="30" class="form-control" rows="3"></textarea>
                                            @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="long_description" class="col-sm-3 col-form-label">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea name="long_description" id="editor" cols="30" rows="10"></textarea>
                                            @error('long_description')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <label for="selling_price" class="col-sm-3 col-form-label"></label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-check form-check-primary mb-3">
                                                        <input class="form-check-input" name="featured_status" value="1" type="checkbox" id="featureProduct" >
                                                        <label class="form-check-label" for="featureProduct">
                                                            Feature Product
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-check form-check-primary mb-3">
                                                        <input class="form-check-input" name="special_offer" value="1" type="checkbox" id="specialOffer">
                                                        <label class="form-check-label" for="specialOffer">
                                                            Special Offer
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
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
