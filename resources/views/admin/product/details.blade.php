@extends('admin.master')
@section('title', 'Product Details')
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
                                <li class="breadcrumb-item active">Details</li>
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
                            <h4 class="card-title mb-5">{{ $product->name }}</h4>

                            <table class="table">
                                <tr>
                                    <th>Product Name</th>
                                    <td>{{ $product->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Code</th>
                                    <td>{{ $product->code }}</td>
                                </tr>
                                <tr>
                                    <th>Product Model</th>
                                    <td>{{ $product->model }}</td>
                                </tr>
                                <tr>
                                    <th>Product Category</th>
                                    <td>{{ $product->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product SubCategory</th>
                                    <td>{{ $product->subCategory->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Brand</th>
                                    <td>{{ $product->brand->name }}</td>
                                </tr>
                                <tr>
                                    <th>Product Stock</th>
                                    <td>{{ $product->stock_amount }} {{ $product->unit->name }}</td>
                                </tr>
                                <tr>
                                    <th>Regular Price</th>
                                    <td>{{ $product->regular_price }}&#2547;</td>
                                </tr>
                                <tr>
                                    <th>Selling Price</th>
                                    <td>{{ $product->selling_price }}&#2547;</td>
                                </tr>
                                <tr>
                                    <th>Feature Status</th>
                                    <td>
                                        <span class="badge badge-soft-primary">{{ $product->featured_status === 1 ? 'Feature Product' : 'Not Feature Product' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Special Offer</th>
                                    <td>
                                        <span class="badge badge-soft-primary">{{ $product->special_offer === 1 ? 'Yes' : 'No' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sales Count</th>
                                    <td>
                                        <span class="badge  badge-soft-primary">{{ $product->sales_count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Hit Count</th>
                                    <td>
                                        <span class="badge  badge-soft-primary">{{ $product->hit_count }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Image</th>
                                    <td>
                                        <img src="{{ asset($product->image) }}" width="100" height="60" alt="">
                                        @foreach(explode('|', $product->other_images) as $image)
                                            <img src="{{ asset($image) }}" width="100" height="60" alt="">
                                        @endforeach
                                    </td>
                                </tr>
                                <tr >
                                    <th>Short Description</th>
                                    <td style="width: 80%">{!! $product->short_description !!}</td>
                                </tr>
                                <tr>
                                    <th>Long Description</th>
                                    <td>{!! $product->long_description !!} </td>
                                </tr>
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
